<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\OrderWS;
use App\Http\Resources\PaymentMethodWS;
use App\Models\AccumulatedPointsStatus;
use App\Models\Branch;
use App\Models\Corporate;
use App\Models\Country;
use App\Models\Distributor;
use App\Models\ExternalGainedPoint;
use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PointsHistory;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\ReorderRequest;
use App\Models\ReorderRequestStatus;
use App\Models\TrafficLights;
use App\Services\DateFormatterService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;

class OrderController extends Controller
{
    public function saveOrderWithExternalPoints(Request $request){

        $productsOrder = $request->input('products');
        $distributorId = $request->input('distributor_id');
        $branchId = $request->input('branch_id');
        $shippingAddressId = $request->input('address_id', 0);

        $distributors = $request->input('distributors');
        $pointsForDistributor = $request->input('points_for_dist');
        $leftover = $request->input('leftover',0);

        if(count($productsOrder) <= 0){
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => [
                    'message' => 'Lista de productos inválida',
                    'order_id' => 0,
                    'current_points' => 0,
                ]
            ]);
        }

        /** @var Branch $branch */
        $branch = Branch::find($branchId);

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        if($distributor->bank_account_number == null) {
            return response()->json([
                'success' => false,
                'message' => 'Atención',
                'data' => [
                    'message' => 'El pedido no pudo finalizarse por que no cuenta con datos bancarios registrados, consulte con su administrador.',
                    'order_id' => 0,
                    'current_points' => 0,
                ]
            ]);
        }


        $totalPrice = 0;
        $totalTaxes = 0;
        $points = 0;
        $countProducts = 0;

        foreach ($productsOrder as $productItem){

            /** @var Product $product */
            $product = Product::find($productItem['id']);

            $totalPrice += $product->distributor_price*$productItem['quantity'];
            $totalTaxes += (((($product->country->tax_percentage*0.01)*($product->distributor_price*$productItem['quantity']))));
            $points += ($product->points*$productItem['quantity']);
            $countProducts += $productItem['quantity'];

        }

        try{
            \DB::beginTransaction();

            $order = new Order();
            $order->total_price = $totalPrice;
            $order->total_taxes = $totalTaxes;
            $order->total_accumulated_points = $points;
            $order->shipping_price = $countProducts * 0.90;
            $order->fk_id_distributor = $distributor->id;
            $order->fk_id_order_status = OrderStatus::PENDING;
            $order->fk_id_branch = $branch->id;
            $order->fk_id_payment_method = PaymentMethod::CART;
            if($shippingAddressId != 0){
                $order->fk_id_shipping_address = $shippingAddressId;
            }

            $order->saveOrFail();

            $reorder = new ReorderRequest();
            $reorder->fk_id_distributor = $distributor->id;
            $reorder->fk_id_reorder_request_status = ReorderRequestStatus::SENT_REQUEST;
            $reorder->saveOrFail();

            foreach ($productsOrder as $productItem){

                /** @var Product $product */
                $product = Product::find($productItem['id']);

                $order->products()->attach($product->id, [
                    'price' => ($product->distributor_price * $productItem['quantity']),
                    'quantity' => $productItem['quantity'],
                ]);
                $order->saveOrFail();

                $reorder->products()->attach($product->id, [
                    'quantity' => $productItem['quantity'],
                ]);

                $currentStock = $branch->products()->where('product.id', $product->id)->first()->pivot->stock;
                $newStock = $currentStock - $productItem['quantity'];

                $branch->products()->updateExistingPivot($product->id,['stock'=> $newStock]);
                $branch->saveOrFail();

                $movement = new Movement();
                $movement->comment = 'Venta de producto, orden con folio '.$order->id;
                $movement->type = 0;
                $movement->quantity = $productItem['quantity'];
                $movement->fk_id_product = $product->id;
                $movement->saveOrFail();

            }

            /*** AQUI EMPIEZA DISTRIBUCIÓN DE PUNTOS
             *  */

            $longFinalMessage = "";

            $countryId = $order->branch->address->country->id;

            $amount = 0;

            $distributorsMail = collect(new Distributor);

            foreach ($distributors as $distributorItem){

                /** @var Distributor $distributorTemp */
                $distributorTemp = Distributor::whereId($distributorItem['id'])->first();

                $distributorsMail->add($distributorTemp);

                /** @var PointsHistory $point */
                $point = PointsHistory::find($distributorTemp->currentPoints->first()->id);
                $point->accumulated_points = $distributorTemp->fk_id_country == Country::MEX ? $point->accumulated_points+$distributorItem['points'] : $point->accumulated_points;
                $point->accumulated_money = $distributorTemp->fk_id_country == Country::USA ? $point->accumulated_money+$distributorItem['points'] : $point->accumulated_money;
                $point->save();
                $point->fk_id_accumulated_points_status = AccumulatedPointsStatus::getPointHistoryStatus($distributorTemp->id);
                $point->save();

                $externalPoints = new ExternalGainedPoint();
                $externalPoints->points = $distributorItem['points'];
                $externalPoints->fk_id_point_history = $point->id;
                $externalPoints->fk_id_order = $order->id;
                $externalPoints->save();

                $indication = $this::getPromos($order->id, $distributorTemp->id);

                if($countryId == Country::USA){
                    $amount = $distributorTemp->fresh()->currentPoints[0]->accumulated_money;
                } elseif ($countryId == Country::MEX){
                    $amount = $distributorTemp->fresh()->currentPoints[0]->accumulated_points;
                }

                $longFinalMessage .= $distributorTemp->name.", alcanzaste un puntaje de ".$amount.". \n".
                                     $indication."\n\n";

            }

            /** @var PointsHistory $point */
            $point = PointsHistory::find($distributor->currentPoints->first()->id);
            $point->accumulated_points = $distributorTemp->fk_id_country == Country::MEX ? $point->accumulated_points+($pointsForDistributor+$leftover) : $points;
            $point->accumulated_money = $distributorTemp->fk_id_country == Country::USA ? $point->accumulated_money+($pointsForDistributor+$leftover) : $totalPrice;
            $point->save();
            $point->fk_id_accumulated_points_status = AccumulatedPointsStatus::getPointHistoryStatus($distributor->id);
            $point->save();

            $externalPoints = new ExternalGainedPoint();
            $externalPoints->points = $pointsForDistributor+$leftover;
            $externalPoints->fk_id_point_history = $point->id;
            $externalPoints->fk_id_order = $order->id;
            $externalPoints->save();

            $indication = $this::getPromos($order->id, $distributor->id);
            $longFinalMessage .= $indication."\n\n";

            if($countryId == Country::USA){
                $amount = $distributor->fresh()->currentPoints[0]->accumulated_money;
            } elseif ($countryId == Country::MEX){
                $amount = $distributor->fresh()->currentPoints[0]->accumulated_points;
            }

            $message = "La compra con el folio ".$order->id." fue realizada con éxito. \n".
                $distributor->name.", alcanzaste un puntaje de ".$amount.". \n".
                "Periodo: ".DateFormatterService::fullDatetime(Carbon::parse($distributor->fresh()->currentPoints[0]->begin_period))." al ".DateFormatterService::fullDatetime(Carbon::parse($distributor->fresh()->currentPoints[0]->end_period)).". \n".
                "Semáforo: ".$distributor->fresh()->currentPoints[0]->accumulatedPointsStatus->trafficLight->name.". \n\n".
                $longFinalMessage;

            $currentPointsMessage = $distributor->fresh()->fk_id_country == Country::MEX ? $distributor->fresh()->currentPoints[0]->accumulated_points : $distributor->fresh()->currentPoints[0]->accumulated_money;

            \DB::commit();

            $targets = [env('GJANA_PERSONAL_MAIL')];

            Mail::send(
                'Web.mail.order',
                [
                    'order' => $order,
                    'distributors' => $distributorsMail,
                    'pointsForDistributor' => ($pointsForDistributor+$leftover)
                ],
                function ($msg) use ($targets) {
                    $msg->subject('GJana | Orden de compra');
                    $msg->bcc($targets);
                }
            );

            return response()->json([
                'success' => true,
                'message' => 'Compra completada',
                'data' => [
                    'message' => $message,
                    'order_id' => $order->id,
                    'current_points' => $currentPointsMessage,

                ]
            ]);

        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => [
                    'message' => $e->getMessage(),
                    'order_id' => 0,
                    'current_points' => 0,
                ]
            ]);
        }
    }

    public function saveOrder(Request $request){

        $productsOrder = $request->input('products');
        $distributorId = $request->input('distributor_id');
        $branchId = $request->input('branch_id');
        $shippingAddressId = $request->input('address_id', 0);
        $paymentMethodId = $request->input('payment_method_id');

        if(count($productsOrder) <= 0){
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => [
                    'message' => 'Lista de productos inválida',
                    'order_id' => 0,
                    'current_points' => 0,
                ]
            ]);
        }

        /** @var Branch $branch */
        $branch = Branch::find($branchId);

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);


        if($distributor->bank_account_number == null) {
            return response()->json([
                'success' => false,
                'message' => 'Atención',
                'data' => [
                    'message' => 'El pedido no pudo finalizarse por que no cuenta con datos bancarios registrados, consulte con su administrador.',
                    'order_id' => 0,
                    'current_points' => 0,
                ]
            ]);
        }

        $totalPrice = 0;
        $totalTaxes = 0;
        $points = 0;
        $countProducts = 0;

        foreach ($productsOrder as $productItem){

            /** @var Product $product */
            $product = Product::find($productItem['id']);

            $totalPrice += $product->distributor_price*$productItem['quantity'];
            $totalTaxes += (((($product->country->tax_percentage*0.01)*($product->distributor_price*$productItem['quantity']))));
            $points += ($product->points*$productItem['quantity']);
            $countProducts += $productItem['quantity'];

        }

        try{
            \DB::beginTransaction();

            $order = new Order();
            $order->total_price = $totalPrice;
            $order->total_taxes = $totalTaxes;
            $order->total_accumulated_points = $points;
            $order->shipping_price = $countProducts * 0.90;
            $order->fk_id_distributor = $distributor->id;
            $order->fk_id_order_status = OrderStatus::PENDING;
            $order->fk_id_branch = $branch->id;
            $order->fk_id_payment_method = PaymentMethod::CART;
            if($shippingAddressId != 0){
                $order->fk_id_shipping_address = $shippingAddressId;
            }

            $order->saveOrFail();

            $point = PointsHistory::find($distributor->currentPoints->first()->id);
            $point->accumulated_points = $point->accumulated_points+$points;
            $point->accumulated_money = $point->accumulated_money+$totalPrice;
            $point->save();
            $point->fk_id_accumulated_points_status = AccumulatedPointsStatus::getPointHistoryStatus($distributor->id);
            $point->save();

            $reorder = new ReorderRequest();
            $reorder->fk_id_distributor = $distributor->id;
            $reorder->fk_id_reorder_request_status = ReorderRequestStatus::SENT_REQUEST;
            $reorder->saveOrFail();

            foreach ($productsOrder as $productItem){

                /** @var Product $product */
                $product = Product::find($productItem['id']);

                $order->products()->attach($product->id, [
                    'price' => ($product->distributor_price * $productItem['quantity']),
                    'quantity' => $productItem['quantity'],
                ]);
                $order->saveOrFail();

                $reorder->products()->attach($product->id, [
                    'quantity' => $productItem['quantity'],
                ]);

                $currentStock = $branch->products()->where('product.id', $product->id)->first()->pivot->stock;
                $newStock = $currentStock - $productItem['quantity'];

                $branch->products()->updateExistingPivot($product->id,['stock'=> $newStock]);
                $branch->saveOrFail();

                $movement = new Movement();
                $movement->comment = 'Venta de producto, orden con folio '.$order->id;
                $movement->type = 0;
                $movement->quantity = $productItem['quantity'];
                $movement->fk_id_product = $product->id;
                $movement->saveOrFail();

            }

            $indication = $this::getPromos($order->id, $distributor->id);
            $countryId = $order->branch->address->country->id;
            $amount = 0;

            if($countryId == Country::USA){
                $amount = $distributor->fresh()->currentPoints[0]->accumulated_money;
            } elseif ($countryId == Country::MEX){
                $amount = $distributor->fresh()->currentPoints[0]->accumulated_points;
            }

            $message = "La compra con el folio ".$order->id." fue realizada con éxito. \n".
                $distributor->name.", alcanzaste un puntaje de ".$amount.". \n".
                "Periodo: ".DateFormatterService::fullDatetime(Carbon::parse($distributor->fresh()->currentPoints[0]->begin_period))." al ".DateFormatterService::fullDatetime(Carbon::parse($distributor->fresh()->currentPoints[0]->end_period)).". \n".
                "Semáforo: ".$distributor->fresh()->currentPoints[0]->accumulatedPointsStatus->trafficLight->name.". \n".
                $indication;

            $currentPointsMessage = $distributor->fresh()->fk_id_country == Country::MEX ? $distributor->fresh()->currentPoints[0]->accumulated_points : $distributor->fresh()->currentPoints[0]->accumulated_money;

            \DB::commit();

            $targets = [env('GJANA_PERSONAL_MAIL')];

            Mail::send(
                'Web.mail.order',
                [
                    'order' => $order,
                ],
                function ($msg) use ($targets) {
                    $msg->subject('GJana | Orden de compra');
                    $msg->bcc($targets);
                }
            );

            return response()->json([
                'success' => true,
                'message' => 'Compra completada',
                'data' => [
                    'message' => $message,
                    'order_id' => $order->id,
                    'current_points' => $currentPointsMessage,

                ]
            ]);

        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => [
                    'message' => $e->getMessage(),
                    'order_id' => 0,
                    'current_points' => 0,
                ]
            ]);
        }

    }

    private function getPromos($orderId, $distributorId){

        $message = "";

        /** @var Order $order */
        $order = Order::find($orderId);

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        $currentPointsPeriod = $distributor->currentPoints[0];
        $countryId = $order->branch->address->country->id;

        $promotions = Promotion::whereFkIdCountry($countryId)
                                ->whereDate('begin_date', '<=', Carbon::now())
                                ->whereDate('expiration_date', '>=', Carbon::now())->get();

        if($promotions != null){

            $promosAccumulative = [];
            $promosSingleOrder = [];

            foreach ($promotions as $promotion){

                if($promotion->is_accumulative){ //Promoción con monto mínimo acumulativo

                    $amount = 0;

                    if($countryId == Country::USA){
                        $amount = $currentPointsPeriod->accumulated_money;
                    } elseif ($countryId == Country::MEX){
                        $amount = $currentPointsPeriod->accumulated_points;
                    }

                    if($amount >= $promotion->min_amount ){
                        $promoAssigned = $distributor->promotions()->where('promotion.id',$promotion->id)->first();
                        if($promoAssigned == null){
                            $distributor->promotions()->attach($promotion->id);
                            $distributor->save();
                            $promosAccumulative[] = $distributor->name.', obtuviste la promoción '.$promotion->name. '. Detalles: '.$promotion->description.'. ';
                        }
                    }

                } else { // Promoción de una compra

                    $amount = 0;

                    if($countryId == Country::USA){
                        $amount = $order->total_price;
                    } elseif ($countryId == Country::MEX){
                        $amount = $promotion->with_points ? $order->total_accumulated_points : $order->total_price;
                    }

                    if($amount >= $promotion->min_amount ){
                        $promoAssigned = $distributor->promotions()->where('promotion.id',$promotion->id)->first();
                        if($promoAssigned == null){
                            $distributor->promotions()->attach($promotion->id);
                            $distributor->save();
                            $promosSingleOrder[] = $distributor->name.', obtuviste la promoción '.$promotion->name. '. Detalles: '.$promotion->description.'. ';
                        }
                    }

                }
            }

            if(count($promosAccumulative) > 0){
               foreach ($promosAccumulative as $promoMessage){

                   $message .= $promoMessage;

               }
            } else {

                $limit = AccumulatedPointsStatus::where('fk_id_country', $countryId)->where('fk_id_traffic_lights', TrafficLights::GREEN)->first()->limit;

                $amount = 0;

                if($countryId == Country::USA){
                    $amount = $currentPointsPeriod->accumulated_money;
                } elseif ($countryId == Country::MEX){
                    $amount = $currentPointsPeriod->accumulated_points;
                }

                if($amount < $limit){
                    $points = $limit - $amount;
                    $message .= "Atención ".$distributor->name.": Te falta ".$points." para alcanzar la cuota. ";
                }

            }

            if(count($promosSingleOrder ) > 0){

                foreach ($promosSingleOrder as $promoMessage){

                    $message .= $promoMessage;

                }

            }

        } else {

            $limit = AccumulatedPointsStatus::where('fk_id_country', $countryId)->where('fk_id_traffic_lights', TrafficLights::GREEN)->first()->limit;

            $amount = 0;

            if($countryId == Country::USA){
                $amount = $currentPointsPeriod->accumulated_money;
            } elseif ($countryId == Country::MEX){
                $amount = $currentPointsPeriod->accumulated_points;
            }

            if($amount < $limit){
                $points = $limit - $amount;
                $message .= "Atención ".$distributor->name.": Te falta ".$points." para alcanzar la cuota. ";
            }

        }

        return $message;

    }

    public function generateIntent(Request $request)
    {

        $amount = floatval($request->input('amount'));
        $currency = $request->input('currency'); // mxn,usd

        Stripe::setApiKey(env('STRIPE_SCREED_KEY'));

        try {
            $intent = PaymentIntent::create([
                'amount' => ($amount * 100),
                'currency' => $currency,
                'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Correcto',
                'data' => $intent->client_secret
            ], 200);

        } catch (ApiErrorException $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ]);

        }
    }

    public function getPaymentMethods(){

        $paymentMethods = PaymentMethod::whereActive(true)->get();

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => PaymentMethodWS::collection($paymentMethods)
        ]);

    }

    public function show($orderId){

        /** @var Order $order */
        $order = Order::find($orderId);

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => OrderWS::make($order)
        ]);

    }

    public function validateRegisterPoints($orderId){

        /** @var Order $order */
        $order = Order::find($orderId);

        $dateOrder = Carbon::parse($order->created_at);

        $orderUsed = ExternalGainedPoint::whereFkIdOrder($order->id)->get()->count();

        $today = Carbon::now();
        $day = $today->day;
        $month = $today->month;
        $year = $today->year;

        if($day < 26){
            $monthBefore = Carbon::now()->subMonth()->month;
            $beginDate = Carbon::create($year,$monthBefore,26);
            $endDate = Carbon::create($year,$monthBefore,25)->addMonth();
        } else {
            $beginDate = Carbon::create($year,$month,26);
            $endDate = Carbon::create($year,$month,25)->addMonth();
        }

        if(!$dateOrder->isBetween($beginDate, $endDate)){
            return response()->json([
                'success' => false,
                'message' => 'La orden de compra no se encuentra en el periodo actual',
                'data' => null
            ]);
        }

        if($orderUsed > 0){

            return response()->json([
                'success' => false,
                'message' => 'La orden de compra ya ha sido utilizada para repartir puntos anteriormente',
                'data' => null
            ]);

        }

        if($order->total_accumulated_points == 0){

            return response()->json([
                'success' => false,
                'message' => 'Esta orden de compra no generó puntos',
                'data' => null
            ]);

        }

        return response()->json([
            'success' => true,
            'message' => 'Proceder con registro de puntos',
            'data' => null
        ]);

    }

}

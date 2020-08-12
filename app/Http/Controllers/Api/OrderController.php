<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodWS;
use App\Models\AccumulatedPointsStatus;
use App\Models\Branch;
use App\Models\Corporate;
use App\Models\Country;
use App\Models\Distributor;
use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\ReorderRequest;
use App\Models\ReorderRequestStatus;
use App\Models\TrafficLights;
use App\Notifications\OrderProcessed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;

class OrderController extends Controller
{
    public function saveOrder(Request $request){

        $productsOrder = $request->input('products');
        $distributorId = $request->input('distributor_id');
        $branchId = $request->input('branch_id');
        $shippingAddressId = $request->input('address_id', 0);
        $paymentMethodId = $request->input('payment_method_id');

        /** @var Branch $branch */
        $branch = Branch::find($branchId);

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);


        $totalPrice = 0;
        $totalTaxes = 0;
        $points = 0;

        foreach ($productsOrder as $productItem){

            /** @var Product $product */
            $product = Product::find($productItem['id']);

            $totalPrice += ((($product->distributor_price*$productItem['quantity'])+(($product->country->tax_percentage*0.01)*($product->distributor_price*$productItem['quantity']))));
            $totalTaxes += (((($product->country->tax_percentage*0.01)*($product->distributor_price*$productItem['quantity']))));
            $points += ($product->points*$productItem['quantity']);

        }

        try{
            \DB::beginTransaction();

            $order = new Order();
            $order->total_price = $totalPrice;
            $order->total_taxes = $totalTaxes;
            $order->total_accumulated_points = $points;
            $order->shipping_price = $shippingAddressId == 0 ? 0 : 50;
            $order->fk_id_distributor = $distributor->id;
            $order->fk_id_order_status = OrderStatus::PAID;
            $order->fk_id_branch = $branch->id;
            $order->fk_id_payment_method = $paymentMethodId;
            if($shippingAddressId != 0){
                $order->fk_id_shipping_address = $shippingAddressId;
            }

            $order->saveOrFail();

            $today = Carbon::now();

            foreach ($distributor->accumulatedPointsHistory as $point)
            {
                $begin = Carbon::parse($point->begin_period);
                $end = Carbon::parse($point->end_period);
                if ($today->between($begin,$end))
                {
                    $point->accumulated_points = $point->accumulated_points+$points;
                    $point->accumulated_money = $point->accumulated_money+$totalPrice;
                    $point->save();
                    $point->fk_id_accumulated_points_status = AccumulatedPointsStatus::getPointHistoryStatus($distributor->id);
                    $point->save();
                } else{

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

                    $point = new \App\Models\PointsHistory();
                    $point->begin_period = $beginDate;
                    $point->end_period = $endDate;
                    $point->accumulated_points = $points;
                    $point->accumulated_money = $totalPrice;
                    $point->fk_id_accumulated_points_status = $distributor->fk_id_country == Country::MEX ? 1 : 2;
                    $point->fk_id_distributor = $distributor->id;
                    $point->save();
                }
            }

            $reorder = new ReorderRequest();
            $reorder->fk_id_distributor = $distributor->id;
            $reorder->fk_id_reorder_request_status = ReorderRequestStatus::SENT_REQUEST;
            $reorder->saveOrFail();

            foreach ($productsOrder as $productItem){

                /** @var Product $product */
                $product = Product::find($productItem['id']);

                $order->products()->attach($product->id, [
                    'price' => (($product->distributor_price*$productItem['quantity'])+(($product->country->tax_percentage*0.01)*($product->distributor_price*$productItem['quantity']))),
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

            $indication = $this::getPromos($order->id);
            $countryId = $order->branch->address->country->id;
            $amount = 0;

            if($countryId == Country::USA){
                $amount = $distributor->currentPoints[0]->accumulated_money;
            } elseif ($countryId == Country::MEX){
                $amount = $distributor->currentPoints[0]->accumulated_points;
            }

            $message = "La compra con el folio ".$order->id." fue realizada con éxito. ".
                $distributor->name.", alcanzaste un puntaje de ".$amount.". ".
                "Periodo: ".$distributor->currentPoints[0]->begin_period." - ".$distributor->currentPoints[0]->end_period.". ".
                "Semáforo: ".$distributor->currentPoints[0]->accumulatedPointsStatus->trafficLight->name.". ".
                $indication;

            \DB::commit();

            $corporate = Corporate::whereId(1)->first();
            $corporate->notify(new OrderProcessed($order, null));

        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => [
                    'message' => 'La compra no pudo completarse correctamente',
                    'order_id' => 0
                ]
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Compra completada',
            'data' => [
                'message' => $message,
                'order_id' => $order->id
            ]
        ]);

    }

    private function getPromos($orderId){

        $message = "";

        /** @var Order $order */
        $order = Order::find($orderId);

        /** @var Distributor $distributor */
        $distributor = Distributor::find($order->distributor->id);

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
                            $promosAccumulative[] = 'Obtuviste la promoción '.$promotion->name. '. Detalles: '.$promotion->description.'. ';
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
                            $promosSingleOrder[] = 'Obtuviste la promoción '.$promotion->name. '. Detalles: '.$promotion->description.'. ';
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
                    $message .= "Atención: Te falta ".$points." para alcanzar la cuota. ";
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
                $message .= "Atención: Te falta ".$points." para alcanzar la cuota. ";
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

}

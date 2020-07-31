<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Distributor;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function saveOrder(Request $request){

        $productsOrder = $request->input('products');
        $distributorId = $request->input('distributor_id');
        $branchId = $request->input('branch_id');
        $shippingAddressId = $request->input('address_id', null);
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
            $order->shipping_price = $shippingAddressId == null ? 0 : 50;
            $order->fk_id_distributor = $distributor->id;
            $order->fk_id_order_status = OrderStatus::PAID;
            $order->fk_id_branch = $branch->id;
            $order->fk_id_payment_method = $paymentMethodId;
            if($shippingAddressId != null){
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
                    $point->save();
                } else{

                    $month = $today->month;
                    $year = $today->year;
                    $beginDate = Carbon::create($year,$month,25);
                    $endDate = $beginDate->addMonth()->addDay();

                    $point = new \App\Models\PointsHistory();
                    $point->begin_period = $beginDate;
                    $point->end_period = $endDate;
                    $point->accumulated_points = $points;
                    $point->fk_id_distributor = $distributor->id;
                    $point->save();
                }
            }

            foreach ($productsOrder as $productItem){

                /** @var Product $product */
                $product = Product::find($productItem['id']);

                $order->products()->attach($product->id, [
                    'price' => (($product->distributor_price*$productItem['quantity'])+(($product->country->tax_percentage*0.01)*($product->distributor_price*$productItem['quantity']))),
                    'quantity' => $productItem['quantity'],
                ]);
                $order->saveOrFail();

            }

            \DB::commit();



        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'error' => $e->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Compra completada',
            'data' => $order->id
        ]);

    }
}

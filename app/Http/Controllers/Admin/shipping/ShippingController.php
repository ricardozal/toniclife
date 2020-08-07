<?php

namespace App\Http\Controllers\Admin\shipping;

use App\Http\Controllers\Controller;

use App\Http\Request\GuideNumberRequest;
use App\Models\Branch;
use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\ShippingGuideNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    public function index()
    {
        return view('admin.shipping.shipping.index');
    }

    public function indexContent(Request $request)
    {

        $order = Order::with(['distributor','status','shippingAddress','branch.address', 'branch', 'guideNumber'])
            ->where('fk_id_shipping_address', '!=', null)
            ->get();

        $query = $order;
        return response()->json([
            'data' => $query
        ]);

    }

    public function guideNumber($orderId)
    {
        $order = Order::find($orderId);

        return view('admin.shipping.shipping.guide_number', [
            'order' => $order
        ]);
    }

    public function guideNumberPost(GuideNumberRequest $request, $orderId){

        /** @var Order $order */
        $order = Order::find($orderId);

        /** @var Branch $branch */
        $branch = Branch::find($order->fk_id_branch);

        try{
            \DB::beginTransaction();

            $shippingGuideNumberId = $order->fk_id_shipping_guide_number;

            if($shippingGuideNumberId != null){

                /** @var ShippingGuideNumber $shippingGuideNumber */
                $shippingGuideNumber = ShippingGuideNumber::find($shippingGuideNumberId);
                $shippingGuideNumber->fill($request->all());
                $shippingGuideNumber->saveOrFail();

            } else {
                $shippingGuideNumber = new ShippingGuideNumber();
                $shippingGuideNumber->fill($request->all());
                $shippingGuideNumber->saveOrFail();
                $order->fk_id_shipping_guide_number = $shippingGuideNumber->id;
                $order->fk_id_order_status = OrderStatus::SENT;
                $order->saveOrFail();

                foreach ($order->products as $product){

                    $currentStock = $branch->products()->where('product.id', $product->id)->first()->pivot->stock;
                    $quantity = $product->pivot->quantity;
                    $newStock = $currentStock - $quantity;

                    if($newStock < 0){
                        return response()->json([
                            'success' => false,
                            'message' => 'Sin stock disponible',
                        ]);
                    } else {
                        $branch->products()->updateExistingPivot($product->id,['stock'=> $newStock]);
                        $branch->saveOrFail();

                        $movement = new Movement();
                        $movement->comment = 'Venta de producto, orden con folio '.$order->id;
                        $movement->type = 0;
                        $movement->quantity = $quantity;
                        $movement->fk_id_product = $product->id;
                        $movement->fk_id_user = Auth::user()->id;
                        $movement->saveOrFail();

                    }
                }
            }

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Proceso completado'
            ]);
        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'error' => $e
            ]);
        }

    }
}

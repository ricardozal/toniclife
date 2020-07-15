<?php

namespace App\Http\Controllers\Admin\shipping;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingToBranchController extends Controller
{
    public  function indexShipping()
    {
        return view('admin.shipping.shippingToBranch.index');
    }

    public function indexContent(Request $request)
    {
        $order = Order::with(['distributor','status','shippingAddress','branch.address', 'branch'])
            ->where('fk_id_shipping_address', '=', null)
            ->get();

        $query = $order;
        return response()->json([
            'data' => $query
        ]);
    }

    public function show($orderId)
    {
        $order = Order::find($orderId);

        return view('admin.shipping.shippingToBranch.show',[
            'order' => $order
        ]);
    }

    public function updateStatus($orderId){
        $order = Order::find($orderId);
        return view('admin.shipping.shippingToBranch.update',['order' => $order]);
    }

    public function updatePostStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        $order->fk_id_order_status = $request->input('fk_id_order_status');
        //$order->fill($request->input('fk_id_order_status'));

        if (!$order->saveOrFail()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar es status'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);
    }
}

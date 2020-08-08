<?php


namespace App\Http\Controllers\Branch;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    public  function index()
    {
        return view('admin.shipping.shippingToBranch.index');
    }

    public function indexContent(Request $request)
    {
        $order = Order::with(['distributor','status','shippingAddress','branch.address', 'branch'])
            ->where('fk_id_shipping_address', '=', null)
            ->where('fk_id_branch', Auth::user()->branch->id)
            ->get();

        $query = $order;
        return response()->json([
            'data' => $query
        ]);
    }

    public function deliver($orderId){

        /** @var Order $order */
        $order = Order::find($orderId);

        $order->fk_id_order_status = OrderStatus::DELIVERED;
        if(!$order->save()){
            return response()->json([
                'success' => false,
                'error' => 'Error al cambiar de estado'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Proceso completado'
        ]);

    }
}

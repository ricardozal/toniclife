<?php


namespace App\Http\Controllers\Branch;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Distributor;
use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    public  function index()

    {
        $locale= session()->get('branch.home.index');
        app()->setLocale($locale);
        return view('admin.shipping.shippingToBranch.index');
    }

    public function indexContent(Request $request)
    {
        $order = Order::with(['distributor','status','shippingAddress','branch.address', 'branch'])
            ->where('fk_id_shipping_address', '=', null)
            ->where('fk_id_branch', Auth::user()->branch->id)
            ->whereIn('fk_id_order_status', [OrderStatus::AUTHORIZED, OrderStatus::DELIVERED])
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

        $title = 'Tu orden fue entregada';
        $body = 'Tu orden con folio '.$order->id.' acaba de ser entregada en la sucursal '.$order->branch->name;

        $recipients = Distributor::whereActive(true)
            ->where('firebase_token', '!=', null)
            ->where('id', $order->fk_id_distributor)
            ->pluck('firebase_token')->toArray();

        fcm()
            ->to($recipients) // $recipients must an array
            ->notification([
                'title' => $title,
                'body' => $body,
            ])
            ->send();

        return response()->json([
            'success' => true,
            'message' => 'Proceso completado'
        ]);

    }
}

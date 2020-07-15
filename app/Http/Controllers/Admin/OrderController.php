<?php


namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Distributor;
use App\Models\PaymentMethod;
use App\Models\OrderStatus;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Request\OrderRequest;


use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.index');
    }

    public function indexContent(Request $request)
    {
        $query = Order::with(['distributor','paymentMethod','status','shippingAddress'])->get();
        return response()->json([
            'data' => $query
        ]);
    }

    public function show($orderId)
    {
        $order = Order::find($orderId);
        dd($order->products);

        return view('admin.order.show',[
            'order' => $order
        ]);
    }

}

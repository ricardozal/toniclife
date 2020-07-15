<?php

namespace App\Http\Controllers\Admin\shipping;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    public  function index()
    {
        return view('admin.shipping.index');
    }

    public function indexContent(Request $request)
    {

        $order = Order::with(['distributor','status','shippingAddress','branch.address', 'branch'])
            ->where('fk_id_shipping_address', '!=', null)
            ->get();

        $query = $order;
        return response()->json([
            'data' => $query
        ]);

    }
}

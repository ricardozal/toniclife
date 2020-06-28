<?php


namespace App\Http\Controllers\Admin;

use App\Models\ReorderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;

class ReorderController extends Controller
{
    public function index()
    {
        return view('admin.reorder.index');
    }

    public function indexContent(Request $request)
    {
        $query = Order::with(['distributor'])->get();
        return response()->json([
            'data' => $query
        ]);


    }

}

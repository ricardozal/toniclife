<?php


namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Request\OrderRequest;
use App\Http\Request\UpdateOrderRequest;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.order.index');
    }

    public function indexContent(Request $request)
    {



    }

    public function update($orderId){
        $order = Order::find($orderId);
        return view('admin.order.upsert',['order' => $order]);
    }

    public function create(){
        return view('admin.order.upsert');
    }

    public function createPost(OrderRequest $request)
    {
        $order = new Order();
        $order->fill($request->all());




        if (!$order->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar al usuario'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);


    }

    public function updatePost(UpdateOrderRequest $request, $orderId)
    {
        $order = Order::find($orderId);

        $order->fill($request->all());



        if (!$order->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar al usuario'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);
    }

    public function active($orderId)
    {
        $order= Order::find($orderId);
        $order->active = !$order->active;
        if (!$order->save()) {
            return response()->json([
                'success' => false,
                'message' => 'no se puede modificar el estatus en este momento'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function delete($orderId)
    {
        $order = Order::find($orderId);

        if (!$order->delete()) {
            return response()->json([
                'success' => false,
                'message' => 'no se puede modificar el estatus en este momento'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
}

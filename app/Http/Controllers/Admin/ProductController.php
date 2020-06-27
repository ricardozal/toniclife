<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function indexContent()
    {
        $query = Product::with(['country'])->get();

        return response()->json([
            'data' => $query
        ]);
    }

    public function update($productId){
        $product = Product::find($productId);
        return view('admin.product.upsert',['product' => $product]);
    }

    public function create(){
        return view('admin.product.upsert');
    }


    public function active($productId)
    {
        $product = Product::find($productId);
        $product->active = !$product->active;
        if (!$product->save()) {
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

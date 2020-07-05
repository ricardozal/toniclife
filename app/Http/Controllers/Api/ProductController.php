<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductWS;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::whereFkIdCountry(1)->limit(10)->get();

        $productList = [];

        foreach ($products as $product)
        {
            $productList[] = new ProductWS($product);
        }

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => $productList
        ]);
    }
}

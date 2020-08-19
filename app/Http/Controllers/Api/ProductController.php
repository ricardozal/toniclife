<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductWS;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts($countryId, $productName)
    {

        $products = Product::whereFkIdCountry($countryId)
            ->where('active',1);

        if($productName != null || $productName != '0'){
            $products->where('name','like','%'.$productName.'%');
        }

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => ProductWS::collection($products->get())
        ]);
    }

    public function showDetails($productId)
    {
        /** @var Product $product */
        $product = Product::find($productId);

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => new ProductWS($product)
        ]);
    }
}

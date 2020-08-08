<?php


namespace App\Http\Controllers\Branch;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request, $countryId){

        $query = $request->input('query', '');
        $response = [
            'suggestions' => [],
            'query' => $query
        ];

        if($countryId != '0'){
            $query2 = Product::whereFkIdCountry($countryId)->where('name','like','%'.$query.'%')->limit(5);
        } else {
            $query2 = Product::where('name','like','%'.$query.'%')->limit(5);
        }

        $products = $query2->get();

        foreach ($products as $product){

            $response['suggestions'][] = [
                'id' => $product->id,
                'value' => $product->name
            ];
        }

        return response()->json($response);

    }
}

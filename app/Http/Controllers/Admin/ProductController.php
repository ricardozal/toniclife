<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Request\ProductRequest;
use App\Http\Request\UpdateProductRequest;
use App\Models\Country;
use App\Models\Product;
use App\Services\UploadFiles;
use Illuminate\Http\Request;

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

    public function createPost(ProductRequest $request)
    {
        $product = new Product();

        $products = Product::whereFkIdCountry($request->input('fk_id_country'))->get();
        $category = Country::whereId($request->input('fk_id_country'))->first();

        foreach ($products as $product)
        {
            if($request->input('code') == $product->code)
            {
                return response()->json([
                    'errors' => ['code' => ['El código en el catálogo '.$category->name.' ya existe']]
                ],422);
            }
        }

        $product->fill($request->all());

        $image = $request->file('file');
        if ($image != null) {
            $url = UploadFiles::storeFile($image, $product->id, 'products');
            $product->image_url = $url;
        }

        if (!$product->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo registrar el producto en este momento, intente más tarde.',
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function updatePost(UpdateProductRequest $request, $productId)
    {
        $product = Product::find($productId);

        if($product->id != $productId)
        {
            $products = Product::whereFkIdCountry($request->input('fk_id_country'))->get();
            $category = Country::whereId($request->input('fk_id_country'))->first();

            foreach ($products as $product)
            {
                if($request->input('code') == $product->code)
                {
                    return response()->json([
                        'errors' => ['code' => ['El código en el catálogo '.$category->name.' ya existe']]
                    ],422);
                }
            }
        }

        $product->fill($request->all());

        $image = $request->file('file');
        if ($image != null) {
            $url = UploadFiles::storeFile($image, $product->id, 'products');
            $product->image_url = $url;
        }

        if (!$product->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo registrar el producto en este momento, intente más tarde.',
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
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

    public function image($productId){
        $product = Product::find($productId);
        return view('admin.product.image',['product' => $product]);
    }

    public function search(Request $request){

        $query = $request->input('query', '');
        $response = [
            'suggestions' => [],
            'query' => $query
        ];


        $query2 = Product::where('code','like','%'.$query.'%');

        $products = $query2->get();

        foreach ($products as $product){

            $response['suggestions'][] = [
                'id' => $product->id,
                'value' => $product->code
            ];
        }

        return response()->json($response);

    }

}

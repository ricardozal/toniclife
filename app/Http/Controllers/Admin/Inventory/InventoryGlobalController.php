<?php


namespace App\Http\Controllers\Admin\Inventory;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryGlobalController extends Controller
{
    public  function indexGlobal()
    {
        return view('admin.inventory.global.index');
    }

    public function indexContent()
    {
        $products = DB::table('branch_has_products')
            ->join('product', 'product.id', '=', 'branch_has_products.fk_id_product')
            ->join('country','country.id','=','product.fk_id_country')
            ->select('product.code','product.name as product_name', 'country.name as country_name', 'fk_id_product', DB::raw('SUM(branch_has_products.stock) AS TOTAL'))
            ->groupBy('branch_has_products.fk_id_product')
            ->get();

        $query = $products;
        return response()->json([
            'data' => $query
        ]);
    }

    public function show($fk_id_product)
    {
        $product = Product::find($fk_id_product);
        $branches = $product->branches;

        return view('admin.inventory.global.show',[
            'branches' => $branches,
            'product' => $product
        ]);
    }

    public function showMovements($fk_id_product)
    {

        dd($fk_id_product);
        $product = Product::find($fk_id_product);

        return view('admin.inventory.global.showMovements',[
            '$product' => $product
        ]);
    }
}

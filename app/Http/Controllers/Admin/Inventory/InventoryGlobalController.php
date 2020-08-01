<?php


namespace App\Http\Controllers\Admin\Inventory;


use App\Http\Controllers\Controller;
use App\Http\Request\InventoryGlobalMovementsRequest;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Movement;
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
        $product = Product::find($fk_id_product);
        return view('admin.inventory.global.showMovements',[
            'product' => $product
        ]);
    }

    public function showTableMovements($fk_id_product)
    {
        $product = Product::find($fk_id_product);
        $movements = $product->movements;

        $query = $movements;
        return response()->json([
            'data' => $query
        ]);
    }

    public function createMovement($fk_id_product)
    {
        $product = Product::find($fk_id_product);

        $originBranches = Branch::whereActive(true)->whereHas('products',function ($q) use ($product) {
            $q->where('product.id',$product->id);
        })->get();

        $destinationBranches = Branch::whereActive(true)->whereHas('address.country',function ($q) use ($product) {
            $q->where('country.id',$product->country->id);
            $q->orWhere('branch.is_matrix',true);
        })->get();

        return view('admin.inventory.global.insertMovement',[
            'product' => $product,
            'originBranches' => $originBranches,
            'destinationBranches' => $destinationBranches
        ]);
    }

    public function createPostMovement(InventoryGlobalMovementsRequest $request, $fk_id_product)
    {
        $branchOrigin = $request->input('fk_id_branch');
        $branchDestination = $request->input('fk_id_branchDestination');
        $stock = $request->input('stock');

        if($branchOrigin == $branchDestination){
            return response()->json([
                'errors' => ['fk_id_branch' => ['No se puede enviar producto a la misma sucursal'],
                            'fk_id_branchDestination' => ['No se puede enviar producto a la misma sucursal']]
            ],422);
        }

        /** @var Branch $branchOriginObj */
        $branchOriginObj = Branch::findOrFail($branchOrigin);
        /** @var Branch $branchDestinationObj */
        $branchDestinationObj = Branch::findOrFail($branchDestination);

        $stockOrigin = $branchOriginObj->products()->where('product.id',$fk_id_product)->first()->pivot->stock;
        $totalStockOrigin = $stockOrigin - $stock;

        if($stockOrigin<$stock){
            return response()->json([
                'errors' => ['stock' => ['No se cubre la cantidad de envío'] ]
            ],422);
        }

        if($stock<1){
            return response()->json([
                'errors' => ['stock' => ['El stock no puede ser menor a 1'] ]
            ],422);
        }

        try{
            \DB::beginTransaction();

            $productStockDestination = $branchDestinationObj->products()->where('product.id',$fk_id_product)->first();
            $stockDestination = 0;
            if($productStockDestination != null){

                $stockDestination = $productStockDestination->pivot->stock;

            }else{

                $branchDestinationObj->products()->attach($fk_id_product,['stock'=>  $stockDestination]);
                $branchDestinationObj->saveOrFail();

            }

            $totalStockDestination = $stockDestination + $stock;

            $branchOriginObj->products()->updateExistingPivot($fk_id_product,['stock'=> $totalStockOrigin]);
            $branchDestinationObj->products()->updateExistingPivot($fk_id_product,['stock'=> $totalStockDestination]);

            $movement = new Movement();
            $movement->comment = 'Traspaso de producto de '.$branchOriginObj->name.' a '.$branchDestinationObj->name;
            $movement->quantity  = $stock;
            $movement->type = 1;
            $movement->fk_id_product  = $fk_id_product;
            $movement->saveOrFail();

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Proceso completado'
            ]);
        } catch (\Throwable $e) {
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'error' => $e
            ]);
        }
    }



}

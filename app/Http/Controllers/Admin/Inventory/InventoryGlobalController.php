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
        return view('admin.inventory.global.insertMovement',[
            'product' => $product
        ]);
    }

    public function createPostMovement(InventoryGlobalMovementsRequest $request, $fk_id_product)
    {
        $branchOrigin = $request->input('fk_id_branch');
        $branchDestination = $request->input('fk_id_branchDestination');

        if($branchOrigin == $branchDestination){
            return response()->json([
                'errors' => ['fk_id_branch' => ['No se puede enviar producto a la misma sucursal'],
                            'fk_id_branchDestination' => ['No se puede enviar producto a la misma sucursal']]
            ],422);
        }


        $stock = $request->input('stock');
        $comment = $request->input('comment');
        $branchOriginObj = Branch::findOrFail($branchOrigin);
        $branchDestinationObj = Branch::findOrFail($branchDestination);

        $stockOrigin = $branchOriginObj->products()->findOrFail($fk_id_product,['stock'])->pivot->stock;
        $stockDestination = $branchDestinationObj->products()->findOrFail($fk_id_product,['stock'])->pivot->stock;

        $totalStockOrigin = $stockOrigin - $stock;

        $movement = new Movement();

        if($stockOrigin<$stock){
            return response()->json([
                'errors' => ['stock' => ['No se cubre la cantidad de envío'] ]
            ],422);
        }

        $totalStockDestination = $stockDestination + $stock;

        try{
            \DB::beginTransaction();

            $movement->comment = $comment;
            $movement->quantity  = $stock;
            $movement->type  = 1;
            $movement->fk_id_product  = $fk_id_product;

            $movement->saveOrFail();

            if($stock<1){
                return response()->json([
                    'errors' => ['stock' => ['El stock no puede ser menor a 1'] ]
                ],422);
            }else{
                $branchOriginObj->products()->updateExistingPivot($fk_id_product,['stock'=> $totalStockOrigin]);
                $branchDestinationObj->products()->updateExistingPivot($fk_id_product,['stock'=> $totalStockDestination]);
            }
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

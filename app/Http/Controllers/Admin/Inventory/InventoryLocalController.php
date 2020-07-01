<?php


namespace App\Http\Controllers\Admin\Inventory;


use App\Http\Controllers\Controller;
use App\Http\Request\InventoryLocalRequest;
use App\Http\Request\InventoryLocalUpdateRequest;
use App\Models\Branch;
use App\Models\BranchHasProduct;
use App\Models\Movement;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryLocalController extends Controller
{
    public function indexLocal($branchId)
    {
        $branch = Branch::find($branchId);
        return view('admin.inventory.local.index',[
            'branch' => $branch
        ]);
    }

    public function indexContent($branchId)
    {
        $query = Branch::find($branchId)->products()->get();
        return response()->json([
            'data' => $query
        ]);
    }

    public function update(Request $request, $branchId){
        $productId = $request->input('productId');
        $branch = Branch::find($branchId);
        $product = Product::find($productId);
        return view('admin.inventory.local.updateStockMovement',[
            'branch' => $branch,
            'product'=>$product
        ]);
    }

    public function updatePost(InventoryLocalUpdateRequest $request)
    {
        $productId = $request->input('productId');
        $branchId = $request->input('branchId');
        $stock = $request->input('stock');
        $comment = $request->input('comment');
        $type = $request->input('type');

        $branchFormId  = Branch::findOrFail($branchId);

        $movement = new Movement();

        $stockBP = $branchFormId->products()->findOrFail($productId,['stock'])->pivot->stock;

        try{
            \DB::beginTransaction();

            $movement->comment = $comment;
            $movement->type = $type;
            $movement->quantity = $stock;
            $movement->fk_id_product = $productId;

            $movement->saveOrFail();

            if (!$type)
            {
                $totalStock = $stockBP - $stock;
                if($totalStock<1){
                    return response()->json([
                        'errors' => ['stock' => ['El stock no puede ser menor a 1'] ]
                    ],422);
                }else{
                    $branchFormId->products()->updateExistingPivot($productId,['stock'=> $totalStock]);
                }

            }else{
                $totalStock = $stockBP + $stock;
                $branchFormId->products()->updateExistingPivot($productId,['stock'=> $totalStock]);
            }

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Proceso completado'
            ]);
        } catch (\Throwable $e){
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'error' => $e
            ]);
        }

    }

    public function createLocal($branchId)
    {
        $branch = Branch::find($branchId);
        return view('admin.inventory.local.upsert',[
            'branchId'=>$branch->id
        ]);
    }

    public function createPost(InventoryLocalRequest $request)
    {


        $branchId = $request->input('branchId');
        $branchFormId  = Branch::findOrFail($branchId);
        $stock = $request->input('stock');
        $productId = $request->input('fk_id_product');


        $products = $branchFormId->products;

        foreach($products as $product)
        {
            if($product->id == $productId)
            {
                return response()->json([
                    'errors' => ['name' => ['El producto ya se encuentra agregado en el inventario'] ]
                ],422);
            }
        }

        $branchFormId->products()->attach($productId,['stock'=>  $stock]);

        if (!$branchFormId->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se guardo el producto'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);

    }

    public function delete(Request $request, $branchId)
    {
        //dd($branchId);
        /*$branchFormId  = Branch::findOrFail($branchId);
        $branchFormId->products()->detach(4);

        return response()->json([
            'success' => true,
        ]);*/
        $branchFormId = Branch::find($branchId);
        $productId = $request->input('productId');
        $branchFormId->products()->detach($productId);


        if (!$branchFormId->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar'
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
}

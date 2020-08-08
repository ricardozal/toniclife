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
use Illuminate\Support\Facades\Auth;

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
        $type = $request->input('type');

        $branchFormId  = Branch::findOrFail($branchId);

        $stockBP = $branchFormId->products()->findOrFail($productId,['stock'])->pivot->stock;

        try{
            \DB::beginTransaction();


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

            $movement = new Movement();
            $movement->comment = 'Reajuste manual de stock de sucursal '.$branchFormId->name;
            $movement->type = $type;
            $movement->quantity = $stock;
            $movement->fk_id_product = $productId;
            $movement->fk_id_user = Auth::user()->id;
            $movement->saveOrFail();

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
        /** @var Product $productNew */
        $productNew = Product::find($productId);

        $products = $branchFormId->products;

        foreach($products as $product)
        {
            if($product->id == $productNew->id)
            {
                return response()->json([
                    'errors' => ['name' => ['El producto ya se encuentra agregado en el inventario'] ]
                ],422);
            }
        }

        $branchFormId->products()->attach($productId,['stock'=>  $stock]);

        $movement = new Movement();
        $movement->comment = 'Se agregó el producto '.$productNew->name.' a la sucursal'.' '.$branchFormId->name;
        $movement->quantity  = $stock;
        $movement->type = 1;
        $movement->fk_id_product  = $productNew->id;
        $movement->fk_id_user = Auth::user()->id;
        $movement->save();

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
}

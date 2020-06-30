<?php


namespace App\Http\Controllers\Admin\Inventory;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchHasProduct;
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

    public function update($branchId){
        $productId = \request()->input('productId');
        $branchP = Branch::find($branchId)->products()->get();
        return view('admin.inventory.local.updateStockMovement',['branchP' => $branchP,'branchId'=>$branchId, 'productId'=>$productId]);
    }

    public function updatePost(Request $request)
    {
        $productId = $request->input('productId');
        $branchId =$request->input('branchId');
        $branchFormId  = Branch::findOrFail($branchId);
        $stock = $request->input('stock');
        $comment = $request->input('comment');
        $branchFormId->products()->updateExistingPivot($productId,['stock'=> $stock]);

        return response()->json([
            'success' => true,
            'message' => 'Guardado correctamente'
        ]);
    }

    public function createLocal($branchId)
    {
        $branch = Branch::find($branchId);
        return view('admin.inventory.local.upsert',[
            'branchId'=>$branch->id
        ]);
    }

    public function createPost(Request $request)
    {
        //dd($request->all());
        $branchId =$request->input('branchId');
        $branchFormId  = Branch::findOrFail($branchId);
        $stock = $request->input('stock');
        $productId = $request->input('fk_id_product');

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

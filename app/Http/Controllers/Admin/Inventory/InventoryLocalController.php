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
        $inventoryL = Branch::find($branchId)->products()->get();
        return view('admin.inventory.local.upsert',['inventoryL' => $inventoryL]);
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
        dd($request->all());
        $branchId = 1;
        $branchFormId  = Branch::findOrFail($branchId);
        $stock = $request->input('stock');
        $branchFormId->products()->attach(1,['stock'=>  $stock]);

    }
}

<?php


namespace App\Http\Controllers\Admin\Inventory;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchHasProduct;
use App\Models\Product;
use http\Env\Request;

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
}

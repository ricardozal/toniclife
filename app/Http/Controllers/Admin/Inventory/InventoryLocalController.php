<?php


namespace App\Http\Controllers\Admin\Inventory;


use App\Http\Controllers\Controller;
use App\Models\Branch;

class InventoryLocalController extends Controller
{
    public function indexLocal($branchId)
    {
        $branch = Branch::find($branchId);
        return view('admin.inventory.local.index',[
            'branch' => $branch
        ]);
    }

    public function indexContent()
    {

    }
}
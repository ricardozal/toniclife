<?php


namespace App\Http\Controllers\Admin\Inventory;


use App\Http\Controllers\Controller;

class InventoryGlobalController extends Controller
{
    public  function index()
    {
        return view('admin.inventory.global.index');
    }

    public function indexContent()
    {

    }
}

<?php


namespace App\Http\Controllers\Branch;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $branch = Branch::find(Auth::user()->branch->id);
//        return view('admin.inventory.local.index',[
//            'branch' => $branch
//        ]);
    }
}

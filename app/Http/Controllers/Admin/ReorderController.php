<?php


namespace App\Http\Controllers\Admin;

use App\Models\ReorderRequest;

use Illuminate\Http\Request;



use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.reorder.index');
    }

    public function indexContent(Request $request)
    {



    }

}

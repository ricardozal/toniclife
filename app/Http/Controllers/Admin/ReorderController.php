<?php


namespace App\Http\Controllers\Admin;

use App\Models\ReorderRequest;

use Illuminate\Http\Request;



use App\Http\Controllers\Controller;

class ReorderController extends Controller
{
    public function index()
    {
        return view('admin.reorder.index');
    }

    public function indexContent(Request $request)
    {



    }

}

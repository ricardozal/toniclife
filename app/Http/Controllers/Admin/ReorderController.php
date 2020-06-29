<?php


namespace App\Http\Controllers\Admin;

use App\Models\ReorderRequest;
use App\Models\Distributor;
use App\Models\ReorderRequestStatus;
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
        $query = ReorderRequest::with(['distributor','status'])->get();
        return response()->json([
            'data' => $query
        ]);


    }

    public function show($reorderId)
    {
        $reorder = ReorderRequest::find($reorderId);

        return view('admin.reorder.show',[
            'reorder' => $reorder
        ]);
    }

}

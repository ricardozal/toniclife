<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\BranchWS;
use App\Models\Branch;

class BranchController extends Controller
{
    public function getBranches()
    {
        $branches = Branch::with(['address'])->where('active',true)->get();

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => BranchWS::collection($branches)
        ]);
    }
}

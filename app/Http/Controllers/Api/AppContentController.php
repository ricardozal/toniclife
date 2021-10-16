<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\MobileAppContent;

class AppContentController extends Controller
{
    public function content(){

        $query = MobileAppContent::all();

        return response()->json([
            'success' => true,
            'message' => 'Todo bien',
            'data' => $query
        ]);

    }
}

<?php


namespace App\Http\Controllers\Admin\shipping;


use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.shipping.menu');
    }
}

<?php

namespace App\Http\Controllers\Admin\shipping;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingToBranchController extends Controller
{
    public  function indexShipping()
    {
        return view('admin.shipping.shippingToBranch.index');
    }
}

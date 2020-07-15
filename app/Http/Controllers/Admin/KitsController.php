<?php


namespace App\Http\Controllers\Admin;

use App\Models\Distributor;
use App\Models\NewDistributor;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Request\OrderRequest;


use App\Http\Controllers\Controller;

class KitsController extends Controller
{
    public function index()
    {
        return view('admin.kits.index');
    }

    public function indexContent(Request $request)
    {
        $query = NewDistributor::with('order.distributor')->get();
        return response()->json([
            'data' => $query
        ]);
    }

    public function showInformation($idNewDistributor)
    {
        $newDistributor = NewDistributor::find($idNewDistributor);

        return view('admin.kits.information',[
            'newDistributor' => $newDistributor
        ]);
    }

    public function showTicket($idNewDistributor)
    {
        $newDistributor = NewDistributor::find($idNewDistributor);

        $idOrder = $newDistributor->fk_id_order;

        $order = Order::find($idOrder);

        return view('admin.kits.ticket',[
            'order' => $order
        ]);
    }
}

<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Resources\OrgChart;
use App\Models\Distributor;

class OrganizationChartController extends Controller
{
    public function index()
    {
        $distributors = Distributor::with('distributors');
        return view('admin.org_chart.index',['distributors' => $distributors]);
    }

    public function indexContent()
    {
        $distributors = Distributor::with('distributors')
            ->where('fk_id_distributor', null)
            ->get();

        return response()->json([
        ['head' => 'Alejandra',
            'id' => 0,
            'contents' => '<strong>Raíz</strong>',
            'children' => OrgChart::collection($distributors)]
        ]);

    }

}

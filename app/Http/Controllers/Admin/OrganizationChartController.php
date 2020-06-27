<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
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

        $dataset = [];

        foreach($distributors as $key=>$distributor)
        {
            $dataset[$key] = $this->getChildren($distributor);
        }

        return response()->json($dataset);
    }

    public function getChildren($distributor)
    {
        $data = [];

        if($distributor->distributors != null)
        {
            $iio = $distributor->distributors->count();
            for($i = 0; $i < $iio; $i++)
            {
                $data['name'][$i] = $distributor->distributors[$iio]->name;
                $this->getChildren($distributor->distributors[$iio]);
            }
        }

    }
}

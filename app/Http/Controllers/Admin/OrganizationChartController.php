<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Resources\OrgChart;
use App\Models\Distributor;
use Carbon\Carbon;

class OrganizationChartController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $day = $today->day;
        $month = $today->month;
        $year = $today->year;

        if($day < 26){
            $monthBefore = Carbon::now()->subMonth()->month;
            $beginDate = Carbon::create($year,$monthBefore,26);
            $endDate = Carbon::create($year,$monthBefore,25)->addMonth();
        } else {
            $beginDate = Carbon::create($year,$month,26);
            $endDate = Carbon::create($year,$month,25)->addMonth();
        }
        return view('admin.org_chart.index',[
            'begin_period' => $beginDate,
            'end_period' => $endDate
        ]);
    }

    public function indexContent()
    {
        $distributors = Distributor::with('distributors')
            ->where('fk_id_distributor', null)
            ->where('active', true)
            ->get();

        return response()->json([
        ['head' => 'Alejandra',
            'id' => 0,
            'contents' => '<strong>Raíz</strong>',
            'children' => OrgChart::collection($distributors)]
        ]);

    }

}

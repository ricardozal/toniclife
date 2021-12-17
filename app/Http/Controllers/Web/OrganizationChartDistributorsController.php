<?php


namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Resources\WebOrgChart;
use App\Models\Distributor;
use Carbon\Carbon;

class OrganizationChartDistributorsController extends Controller
{
    public function index($tonic_life_id)
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
        return view('Web.OrganizationChartDist.index',[
            'begin_period' => $beginDate,
            'end_period' => $endDate,
            'tonic_life_id' => $tonic_life_id
        ]);
    }

    public function indexContent($tonic_life_id)
    {
        $distributors = Distributor::with('distributors')
            ->where('tonic_life_id', $tonic_life_id)
            ->where('active', true)
            ->get();

        return response()->json(
            WebOrgChart::collection($distributors)
        );

    }

}

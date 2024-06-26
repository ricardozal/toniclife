<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\CandidatePromoWS;
use App\Http\Resources\CandidateWS;
use App\Http\Resources\DistWSCantidate;
use App\Models\AccumulatedPointsStatus;
use App\Models\Country;
use App\Models\Distributor;
use App\Models\Product;
use App\Models\TrafficLights;
use Illuminate\Http\Request;

class SharePointsController extends Controller
{
    public function getCandidates(Request $request){

        $productsOrder = $request->input('products');
        $distributorId = $request->input('distributor_id');

        $totalPrice = 0;
        $points = 0;

        if(count($productsOrder) <= 0){
            return response()->json([
                'success' => false,
                'message' => 'Error durante el proceso',
                'data' => [
                    'message' => 'Lista de productos inválida',
                    'order_id' => 0,
                    'current_points' => 0,
                ]
            ]);
        }

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        foreach ($productsOrder as $productItem){

            /** @var Product $product */
            $product = Product::find($productItem['id']);

            $totalPrice += ($product->distributor_price * $productItem['quantity']);
            $points += ($product->points*$productItem['quantity']);

        }

        $candidatesTemp = Distributor::whereFkIdDistributor($distributor->id)
            ->where('fk_id_country',$distributor->fk_id_country)->get();

        $json = DistWSCantidate::collection($candidatesTemp)->toJson();

        $result = $this->flatten(json_decode($json));

        $candidates = Distributor::whereIn('id',$result)
            ->where('fk_id_country',$distributor->fk_id_country)
            ->get();

        $candidatesArray = collect(new Distributor);
        $candidatesPromosArray = collect(new Distributor);

        foreach ($candidates as $candidate){

           if($candidate->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::WHITE ||
              $candidate->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::YELLOW ||
              $candidate->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::RED){

               $candidatesArray->add($candidate);

           } elseif ($candidate->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::GREEN ||
               $candidate->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::LIGHT_BLUE ||
               $candidate->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::STRONG_BLUE){

               $candidatesPromosArray->add($candidate);

           }
        }

        $messageToDist = '';
        $newTotalPoints = 0;
        $pointsForDistributor = 0;

        if( $distributor->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::LIGHT_BLUE ||
            $distributor->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::STRONG_BLUE){

            $messageToDist = 'Ya te encuentras calificado';
            $newTotalPoints = ($distributor->fk_id_country == Country::MEX ? $points : $totalPrice);

        } elseif (!($distributor->currentPoints->first()->accumulatedPointsStatus->trafficLight->id == TrafficLights::GREEN)) {

            $difference = AccumulatedPointsStatus::where('fk_id_country', $distributor->fk_id_country)
                    ->where('fk_id_traffic_lights', TrafficLights::GREEN)->first()->limit -
                    ($distributor->fk_id_country == Country::MEX ?
                    $distributor->currentPoints->first()->accumulated_points :
                    $distributor->currentPoints->first()->accumulated_money);

            $newTotalPoints = (($distributor->fk_id_country == Country::MEX ?
                                $points :
                                $totalPrice) - $difference) <= 0 ? 0 :
                              ($distributor->fk_id_country == Country::MEX ?
                                $points :
                                $totalPrice) - $difference;

            $pointsForDistributor = ($difference > ($distributor->fk_id_country == Country::MEX ? $points : $totalPrice) ? ($distributor->fk_id_country == Country::MEX ? $points : $totalPrice) : $difference);

            $messageToDist = 'Has tomado '.round($pointsForDistributor,2).' puntos.';

        } else {
            $messageToDist = 'Ya te encuentras calificado';
            $newTotalPoints = ($distributor->fk_id_country == Country::MEX ? $points : $totalPrice);
        }

        return response()->json([
            'original_points' => round(($distributor->fk_id_country == Country::MEX ? $points : $totalPrice), 2),
            'total_points' => round($newTotalPoints,2),
            'to_dist' => $messageToDist,
            'points_for_distributor' => round($pointsForDistributor,2),
            'candidates' => $newTotalPoints == 0 ? null : CandidateWS::collection($candidatesArray),
            'candidates_promos' => $newTotalPoints == 0 ? null :  CandidatePromoWS::collection($candidatesPromosArray)
        ]);
    }

    private function flatten($ar) {
        $toflat = array($ar);
        $res = array();

        while (($r = array_shift($toflat)) !== null) {
            foreach ($r as $v) {
                if (is_array($v)) {
                    $toflat[] = $v;
                } else {
                    $res[] = $v;
                }
            }
        }

        return $res;
    }
}

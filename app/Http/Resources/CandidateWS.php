<?php


namespace App\Http\Resources;


use App\Models\AccumulatedPointsStatus;
use App\Models\Country;
use App\Models\Distributor;
use App\Models\TrafficLights;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Distributor $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->currentPoints->first()->accumulatedPointsStatus->trafficLight->color,
            'difference' => round((AccumulatedPointsStatus::where('fk_id_country', $this->fk_id_country)
                                ->where('fk_id_traffic_lights', TrafficLights::GREEN)->first()->limit -
                            ($this->fk_id_country == Country::MEX ?
                                $this->currentPoints->first()->accumulated_points :
                                $this->currentPoints->first()->accumulated_money)),2)
        ];
    }
}

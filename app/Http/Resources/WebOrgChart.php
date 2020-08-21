<?php


namespace App\Http\Resources;


use App\Models\Country;
use App\Models\Distributor;
use Illuminate\Http\Resources\Json\JsonResource;

class WebOrgChart extends JsonResource
{
    public function toArray($request)
    {
        /** @var Distributor $this */

        return [
            'head' => '<div style="overflow: hidden">'.$this->name.'</div>',
            'id' => $this->id,
            'contents' => '<div style="background-color: '.$this->currentPoints[0]->accumulatedPointsStatus->trafficLight->color.'">'.($this->fk_id_country == Country::MEX ? 'MEX' : 'USA').': '.($this->fk_id_country == Country::MEX ? $this->currentPoints[0]->accumulated_points : $this->currentPoints[0]->accumulated_money).'</div>',
            'children' => WebOrgChart::collection($this->distributors)
        ];
    }
}

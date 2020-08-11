<?php


namespace App\Http\Resources;


use App\Models\Distributor;
use Illuminate\Http\Resources\Json\JsonResource;

class OrgChart extends JsonResource
{
    public function toArray($request)
    {
        /** @var Distributor $this */

        return [
            'head' => $this->name,
            'id' => $this->id,
            'contents' => $this->currentPoints[0]->accumulated_points,
            'children' => OrgChart::collection($this->distributors)
        ];
    }
}

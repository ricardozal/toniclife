<?php


namespace App\Http\Resources;


use App\Models\Distributor;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributorWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Distributor $this */

        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}

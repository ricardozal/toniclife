<?php


namespace App\Http\Resources;


use App\Models\Distributor;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class DistWSCantidate extends JsonResource
{
    public function toArray($request)
    {
        /** @var Distributor $this */

        return [
            0 => $this->id,
            1 => DistWSCantidate::collection($this->distributors)
        ];
    }
}

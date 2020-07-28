<?php


namespace App\Http\Resources;


use App\Models\Branch;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Branch $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => AddressWS::make($this->whenLoaded('address'))
        ];
    }
}

<?php


namespace App\Http\Resources;


use App\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Address $this */

        return [
            'id' => $this->id,
            'street' => $this->street,
            'ext_num' => $this->ext_num,
            'int_num' => $this->int_num,
            'zip_code' => $this->zip_code,
            'colony' => $this->colony,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country->name,
            'references' => $this->references,
            'full_address' => $this->FullAddress,
            'alias' => $this->pivot->alias,
            'selected' => $this->pivot->selected == 1
        ];
    }
}

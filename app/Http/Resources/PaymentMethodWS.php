<?php


namespace App\Http\Resources;

use App\Models\PaymentMethod;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var PaymentMethod $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}

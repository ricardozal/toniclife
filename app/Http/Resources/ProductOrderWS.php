<?php


namespace App\Http\Resources;


use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductOrderWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Product $this */

        return [
            'name' => $this->name,
            'points' => $this->points,
            'price' => '$'.number_format(($this->country->tax_percentage*0.01)*($this->distributor_price)+$this->distributor_price,2),
            'quantity' => $this->pivot->quantity,
            'total' => '$'.number_format($this->pivot->price,2),
            'accumulated_points' => $this->points*$this->pivot->quantity
        ];
    }
}

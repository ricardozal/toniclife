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
            'price' => '$'.number_format($this->price_with_tax,2),
            'quantity' => $this->pivot->quantity,
            'total' => '$'.number_format($this->pivot->price,2),
            'accumulated_points' => $this->points*$this->pivot->quantity
        ];
    }
}

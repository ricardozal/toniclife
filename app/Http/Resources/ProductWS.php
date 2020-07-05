<?php


namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Product $this */

        return [
            'name' => $this->name,
            'image_url' => $this->image_url,
            'distributor_price' => $this->distributor_price,
            'tax' => round(($this->country->tax_percentage*0.01)*($this->distributor_price), 2),
            'total' => round(($this->country->tax_percentage*0.01)*($this->distributor_price) + $this->distributor_price, 2),
            'points' => $this->points,
        ];
    }
}

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
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category != null ? $this->category->name : 'Sin categoría',
            'image_url' => $this->absolute_image_url,
            'distributor_price' => $this->distributor_price,
            'tax' => round(($this->country->tax_percentage*0.01)*($this->distributor_price), 2),
            'total' => round($this->price_with_tax, 2),
            'points' => $this->points,
            'is_kit' => $this->is_kit == 1,
            'inventory' => $this->available_inventory
        ];
    }
}

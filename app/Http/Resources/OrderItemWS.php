<?php


namespace App\Http\Resources;


use App\Models\Order;
use App\Services\DateFormatterService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Order $this */

        return [
            'id' => $this->id,
            'date' => DateFormatterService::fullDatetime(Carbon::parse($this->created_at)),
            'total_price' => '$'.number_format($this->total_price + $this->shipping_price,2),
            'total_points' => number_format($this->total_accumulated_points,2),
            'total_products' => $this->products->count(),
            'status' => $this->status->name,
            'delivery' => $this->shippingAddress != null ? ($this->guideNumber != null ? 'Tu orden ha sido enviada, no. guía: '.$this->guideNumber->value.' de '.$this->guideNumber->officeParcel->name :'Dirección de envío: '.$this->shippingAddress->FullAddress) : 'Recoger en sucursal: '.$this->branch->name
        ];
    }
}

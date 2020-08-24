<?php


namespace App\Http\Resources;


use App\Models\Order;
use App\Services\DateFormatterService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Order $this */

        return [
            'id' => $this->id,
            'date' => DateFormatterService::fullDatetime(Carbon::parse($this->created_at)),
            'total_price' => number_format($this->total_price,2),
            'total_points' => number_format($this->total_accumulated_points,2),
            'total_taxes' => '$'.number_format($this->total_taxes,2),
            'shipping_price' => '$'.number_format($this->shipping_price,2),
            'total_products' => $this->products->count(),
            'products' => ProductOrderWS::collection($this->products),
            'status' => $this->status->name,
            'payment_method' => 'Método de pago: '.$this->paymentMethod->name,
            'delivery' => $this->shippingAddress != null ? ($this->guideNumber != null ? 'Dirección de envío: '.$this->shippingAddress->FullAddress.' Tu orden ha sido enviada, no. guía: '.$this->guideNumber->value.' de '.$this->guideNumber->officeParcel->name :'Dirección de envío: '.$this->shippingAddress->FullAddress) : 'Recoger en sucursal: '.$this->branch->name,
            'country_id' => $this->branch->address->fk_id_country
        ];
    }
}

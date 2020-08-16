<?php


namespace App\Http\Resources;


use App\Models\Promotion;
use App\Services\DateFormatterService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionWS extends JsonResource
{
    public function toArray($request){

        /** @var Promotion $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'date_begin' => DateFormatterService::fullDatetime(Carbon::parse($this->begin_date)),
            'date_end' => DateFormatterService::fullDatetime(Carbon::parse($this->expiration_date)),
            'min_amount' => $this->with_points ? $this->min_amount.' puntos' : '$'.number_format($this->min_amount,2),
            'is_accumulative' => $this->is_accumulative ? 'Promoción con monto mínimo acumulativo' : 'Promoción en una sola compra'
        ];

    }
}

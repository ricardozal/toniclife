<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShippingGuideNumber
 *
 * @property int $id
 * @property string $value
 * @property int $active
 * @property int $fk_id_office_parcel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber whereFkIdOfficeParcel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShippingGuideNumber whereValue($value)
 * @mixin \Eloquent
 */
class ShippingGuideNumber extends Model
{
    protected $table = 'shipping_guide_number';

    protected  $appends = ['guide_number_data'];

    public function getGuideNumberDataAttribute()
    {
        return $this->value.' - '.$this->officeParcel->name;
    }

    public function officeParcel(){

        return $this->belongsTo(
            OfficeParcel::class,
            'fk_id_office_parcel',
            'id'
        );

    }
}

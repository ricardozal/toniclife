<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Address
 *
 * @property int $id
 * @property string $street
 * @property string $zip_code
 * @property string $ext_num
 * @property string|null $int_num
 * @property string $colony
 * @property string $city
 * @property string $state
 * @property string|null $latitude
 * @property string|null $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereColony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereExtNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereIntNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereZipCode($value)
 * @mixin \Eloquent
 * @property int $fk_id_country
 * @property string|null $references
 * @property-read mixed $full_address
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereFkIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereReferences($value)
 * @property-read \App\Models\Country $country
 */
class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
            'street','zip_code','ext_num','int_num','colony','city','state','fk_id_country'
        ];

    protected  $appends = ['FullAddress'];

    public function getFullAddressAttribute()
    {
        return $this->street.', '.$this->zip_code.', '.$this->ext_num.', '.$this->colony.', '.$this->city.', '.$this->state.', '.$this->country->name.'.';
    }

    public function country()
    {
        return $this->belongsTo(
            Country::class,
            'fk_id_country',
            'id'
        );
    }
}

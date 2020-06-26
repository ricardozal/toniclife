<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property float $tax_percentage
 * @property int $active
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereTaxPercentage($value)
 * @mixin \Eloquent
 */
class Country extends Model
{
    protected $table = 'country';
    public $timestamps = false;

    protected $fillable = [
        'name','tax_percentage'
    ];

    public function products()
    {
        return $this->hasMany(
            Product::class,
            'fk_id_country',
            'id'
        );
    }
}

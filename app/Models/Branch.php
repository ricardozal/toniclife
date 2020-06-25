<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Branch
 *
 * @property int $id
 * @property string $name
 * @property int $active
 * @property int $fk_id_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch whereFkIdAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Branch extends Model
{
    protected $table = 'branch';

    protected $fillable = [
        'name',
        'fk_id_address'
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'branch_has_products',
            'fk_id_branch',
            'fk_id_product'
        )->withPivot(['stock']);
    }

    public function address()
    {
        return $this->belongsTo(
            Address::class,
            'fk_id_address',
            'id'
        );
    }

    public static function asMap()
    {
        return self::pluck('name', 'id');
    }

}

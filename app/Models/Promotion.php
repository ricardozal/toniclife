<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Promotion
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $min_amount
 * @property string|null $expiration_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Distributor[] $distributors
 * @property-read int|null $distributors_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $begin_date
 * @property int $with_points
 * @property int $is_accumulative
 * @property int $active
 * @property int $fk_id_country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereBeginDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereFkIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereIsAccumulative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Promotion whereWithPoints($value)
 */
class Promotion extends Model
{
    protected $table = 'promotion';


    protected $fillable = [
        'name',
        'description',
        'min_amount',
        'expiration_date',
        'active'
    ];

    public function distributors()
    {
        return $this->belongsToMany(
            Distributor::class,
            'distributor_has_promotions',
            'fk_id_promotion',
            'fk_id_distributor'
        );
    }

}

<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\Models\Distributor
 *
 * @property int $id
 * @property string $name
 * @property string $tonic_life_id
 * @property string $email
 * @property string $password
 * @property float $accumulated_points
 * @property int $active
 * @property int|null $fk_id_distributor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Distributor[] $distributors
 * @property-read int|null $distributors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Promotion[] $promotions
 * @property-read int|null $promotions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReorderRequest[] $reorderRequests
 * @property-read int|null $reorder_requests_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereAccumulatedPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereFkIdDistributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereTonicLifeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Distributor extends Authenticatable
{

    use HasApiTokens, Notifiable;

    protected $table = 'distributor';

    protected $fillable = [
        'name',
        'tonic_life_id',
        'email',
    ];

    public function products()
    {
        return $this->belongsToMany(
            Address::class,
            'distributor_has_addresses',
            'fk_id_distributor',
            'fk_id_address'
        );
    }

    public function distributors()
    {
        return $this->hasMany(
            Distributor::class,
            'fk_id_distributor',
            'id'
        )->with('distributors');
    }

    public function distributor()
    {
        return $this->belongsTo(
            Distributor::class,
            'fk_id_distributor',
            'id'
        );
    }

    public function promotions()
    {
        return $this->belongsToMany(
            Promotion::class,
            'distributor_has_promotions',
            'fk_id_distributor',
            'fk_id_promotion'
        );
    }

    public function orders()
    {
        return $this->hasMany(
            Order::class,
            'fk_id_distributor',
            'id'
        );
    }

    public function reorderRequests()
    {
        return $this->hasMany(
            ReorderRequest::class,
            'fk_id_distributor',
            'id'
        );
    }

}

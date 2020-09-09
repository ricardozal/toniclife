<?php


namespace App\Models;


use Carbon\Carbon;
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
 * @property int $active
 * @property int|null $fk_id_distributor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Distributor[] $distributors
 * @property-read int|null $distributors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PointsHistory[] $accumulatedPointsHistory
 * @property-read int|null $accumulated_points_history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\Distributor|null $distributor
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PointsHistory[] $currentPoints
 * @property-read int|null $current_points_count
 * @property int $fk_id_country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereFkIdCountry($value)
 * @property string|null $firebase_token
 * @property-read \App\Models\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereFirebaseToken($value)
 * @property string|null $bank_name
 * @property string|null $bank_account_number
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Distributor whereBankName($value)
 */
class Distributor extends Authenticatable
{

    use HasApiTokens, Notifiable;

    protected $table = 'distributor';

    protected $fillable = [
        'name',
        'tonic_life_id',
        'email',
        'fk_id_country',
        'bank_name',
        'bank_account_number'
    ];

    public function addresses()
    {
        return $this->belongsToMany(
            Address::class,
            'distributor_has_addresses',
            'fk_id_distributor',
            'fk_id_address'
        )->withPivot(['alias', 'selected']);
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

    public function accumulatedPointsHistory()
    {
        return $this->hasMany(
            PointsHistory::class,
            'fk_id_distributor',
            'id'
        );
    }

    public function currentPoints()
    {
        $currentPoints = $this->hasMany(
            PointsHistory::class,
            'fk_id_distributor',
            'id'
        )->whereDate('begin_period', '<=', Carbon::now())
         ->whereDate('end_period', '>=', Carbon::now());

        if($currentPoints->get()->count() == 0){
            $today = Carbon::now();
            $day = $today->day;
            $month = $today->month;
            $year = $today->year;

            if($day < 26){
                $monthBefore = Carbon::now()->subMonth()->month;
                $beginDate = Carbon::create($year,$monthBefore,26);
                $endDate = Carbon::create($year,$monthBefore,25)->addMonth();
            } else {
                $beginDate = Carbon::create($year,$month,26);
                $endDate = Carbon::create($year,$month,25)->addMonth();
            }

            $point = new \App\Models\PointsHistory();
            $point->begin_period = $beginDate;
            $point->end_period = $endDate;
            $point->accumulated_points = 0;
            $point->accumulated_money = 0;
            $point->fk_id_accumulated_points_status = $this->fk_id_country == Country::MEX ? 1 : 2;
            $point->fk_id_distributor = $this->id;
            $point->save();

            $currentPoints = $this->hasMany(
                PointsHistory::class,
                'fk_id_distributor',
                'id'
            )->whereDate('begin_period', '<=', Carbon::now())
                ->whereDate('end_period', '>=', Carbon::now());
        }

        return $currentPoints;
    }

    public function country()
    {
        return $this->belongsTo(
            Country::class,
            'fk_id_country',
            'id'
        );
    }

    public static function getPointsExternalOrder($orderId){

        /** @var Order $order */
        $order = Order::find($orderId);

        $pointHistoryId = $order->distributor->currentPoints->first()->id;

        return ExternalGainedPoint::whereFkIdOrder($order->id)->where('fk_id_point_history',$pointHistoryId)->first()->points;

    }

}

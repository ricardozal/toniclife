<?php


namespace App\Models;


use App\Services\DateFormatterService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property float $total_price
 * @property float $total_taxes
 * @property float $total_accumulated_points
 * @property float $shipping_price
 * @property int $bill_required
 * @property int $fk_id_distributor
 * @property int $fk_id_order_status
 * @property int|null $fk_id_shipping_address
 * @property int $fk_id_branch
 * @property int $fk_id_payment_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Branch $branch
 * @property-read \App\Models\Distributor $distributor
 * @property-read \App\Models\PaymentMethod $paymentMethod
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Address|null $shippingAddress
 * @property-read \App\Models\OrderStatus $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBillRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFkIdBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFkIdDistributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFkIdOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFkIdPaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFkIdShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalAccumulatedPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $fk_id_shipping_guide_number
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFkIdShippingGuideNumber($value)
 * @property-read \App\Models\ShippingGuideNumber|null $guideNumber
 * @property-read mixed $format_date
 * @property-read mixed $external_dist
 */
class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'total_price',
        'total_taxes',
        'total_accumulated_points',
        'shipping_price',
        'bill_required',
        'fk_id_distributor',
        'fk_id_order_status',
        'fk_id_shipping_address',
        'fk_id_shipping_address',
        'fk_id_branch',
        'fk_id_payment_method'
    ];

    protected  $appends = ['format_date', 'external_dist'];

    public function getFormatDateAttribute()
    {
        return DateFormatterService::fullDatetime(Carbon::parse($this->created_at));
    }

    public function distributor()
    {
        return $this->belongsTo(
            Distributor::class,
            'fk_id_distributor',
            'id'
        );
    }

    public function status()
    {
        return $this->belongsTo(
            OrderStatus::class,
            'fk_id_order_status',
            'id'
        );
    }

    public function shippingAddress()
    {
        return $this->belongsTo(
            Address::class,
            'fk_id_shipping_address',
            'id'
        );
    }

    public function branch()
    {
        return $this->belongsTo(
            Branch::class,
            'fk_id_branch',
            'id'
        );
    }

    public function paymentMethod()
    {
        return $this->belongsTo(
            PaymentMethod::class,
            'fk_id_payment_method',
            'id'
        );
    }


    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'order_product',
            'fk_id_order',
            'fk_id_product'
        )->withPivot(['price','quantity']);
    }

    public function guideNumber(){

        return$this->belongsTo(
            ShippingGuideNumber::class,
            'fk_id_shipping_guide_number',
            'id'
        );

    }

    public function getExternalDistAttribute(){

        $externalPoints = ExternalGainedPoint::whereFkIdOrder($this->id)->get();

        $distributors = collect(new Distributor);

        foreach ($externalPoints as $externalPoint){

            $distributors->add($externalPoint->pointHistory->distributor);

        }

        return $distributors;

    }

}

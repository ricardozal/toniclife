<?php


namespace App\Models;


use App\Services\DateFormatterService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReorderRequest
 *
 * @property int $id
 * @property int $fk_id_distributor
 * @property int $fk_id_reorder_request_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Distributor $distributor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\ReorderRequestStatus $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequest whereFkIdDistributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequest whereFkIdReorderRequestStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $format_date
 */
class ReorderRequest extends Model
{
    protected $table = 'reorder_request';

    protected $fillable = [

        'fk_id_distributor',
        'fk_id_reorder_request_status',
        'created_at',
        'updated_at'
    ];

    protected  $appends = ['format_date'];

    public function getFormatDateAttribute()
    {
        return DateFormatterService::fullDatetime(Carbon::parse($this->created_at));
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'reorder_request_product',
            'fk_id_reorder_request',
            'fk_id_product'
        )->withPivot(['quantity']);
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
            ReorderRequestStatus::class,
            'fk_id_reorder_request_status',
            'id'
        );
    }

}

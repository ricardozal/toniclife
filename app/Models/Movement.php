<?php


namespace App\Models;


use App\Services\DateFormatterService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Movement
 *
 * @property int $id
 * @property string $comment
 * @property int $type
 * @property int $quantity
 * @property int $fk_id_product
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement whereFkIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $fk_id_user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movement whereFkIdUser($value)
 * @property-read \App\Models\User $user
 * @property-read mixed $format_date
 */
class Movement extends Model
{
    protected $table = 'movement';

    protected  $appends = ['format_date'];

    public function getFormatDateAttribute()
    {
        return DateFormatterService::fullDatetime(Carbon::parse($this->created_at));
    }

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'fk_id_product',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'fk_id_user',
            'id'
        );
    }


}

<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderStatus
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereName($value)
 * @mixin \Eloquent
 */
class OrderStatus extends Model
{
    protected $table = 'order_status';

    const PAID = 1;
    const SENT = 2;
    const DELIVERED = 3;
    const CANCELED = 4;
    const PENDING = 5;
    const AUTHORIZED = 6;

    protected $fillable = [
        'name'
    ];

    public static function asMap()
    {
        return self::pluck('name', 'id');
    }

    public static function asMapAuthorize(){

        return self::whereIn('id', [self::CANCELED,self::AUTHORIZED])->get()->pluck('name', 'id');

    }



}

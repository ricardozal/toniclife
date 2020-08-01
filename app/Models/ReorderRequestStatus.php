<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReorderRequestStatus
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestStatus whereName($value)
 * @mixin \Eloquent
 */
class ReorderRequestStatus extends Model
{
    protected $table = 'reorder_request_status';

    const SENT_REQUEST = 1;
    const DELIVERED = 2;

    protected $fillable = [
        'name'
    ];


}

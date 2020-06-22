<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReorderRequestProduct
 *
 * @property int $id
 * @property int $quantity
 * @property int $fk_id_product
 * @property int $fk_id_reorder_request
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestProduct whereFkIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestProduct whereFkIdReorderRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReorderRequestProduct whereQuantity($value)
 * @mixin \Eloquent
 */
class ReorderRequestProduct extends Model
{
    protected $table = 'reorder_request_product';
}

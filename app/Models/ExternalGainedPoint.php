<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExternalGainedPoint
 *
 * @property int $id
 * @property float $points
 * @property int $fk_id_point_history
 * @property int|null $fk_id_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint whereFkIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint whereFkIdPointHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $money
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalGainedPoint whereMoney($value)
 * @property-read \App\Models\PointsHistory $pointHistory
 */
class ExternalGainedPoint extends Model
{
    protected $table = 'external_gained_points';

    public function pointHistory(){

        return $this->belongsTo(
            PointsHistory::class,
            'fk_id_point_history',
            'id'
        );

    }

}

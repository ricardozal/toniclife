<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PointsHistory
 *
 * @property int $id
 * @property float $accumulated_points
 * @property string $begin_period
 * @property string $end_period
 * @property int|null $fk_id_distributor
 * @property-read \App\Models\Distributor|null $distributor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointsHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointsHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointsHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointsHistory whereAccumulatedPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointsHistory whereBeginPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointsHistory whereEndPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointsHistory whereFkIdDistributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointsHistory whereId($value)
 * @mixin \Eloquent
 */
class PointsHistory extends Model
{
    protected $table = 'point_history';
    public $timestamps = false;

    public function distributor()
    {
        return $this->belongsTo(
            Distributor::class,
            'fk_id_distributor',
            'id'
        );
    }

}

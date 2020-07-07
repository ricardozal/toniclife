<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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

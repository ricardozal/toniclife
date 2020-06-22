<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotion';

    public function distributors()
    {
        return $this->belongsToMany(
            Distributor::class,
            'distributor_has_promotions',
            'fk_id_promotion',
            'fk_id_distributor'
        );
    }

}

<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributor';

    public function products()
    {
        return $this->belongsToMany(
            Address::class,
            'distributor_has_addresses',
            'fk_id_distributor',
            'fk_id_address'
        );
    }

    public function distributors()
    {
        return $this->hasMany(
            Distributor::class,
            'fk_id_distributor',
            'id'
        );
    }

    public function promotions()
    {
        return $this->belongsToMany(
            Promotion::class,
            'distributor_has_promotions',
            'fk_id_distributor',
            'fk_id_promotion'
        );
    }

    public function orders()
    {
        return $this->hasMany(
            Order::class,
            'fk_id_distributor',
            'id'
        );
    }

    public function reorderRequests()
    {
        return $this->hasMany(
            ReorderRequest::class,
            'fk_id_distributor',
            'id'
        );
    }

}

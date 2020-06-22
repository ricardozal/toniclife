<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';

    public function products()
    {
        return $this->hasMany(
            Product::class,
            'fk_id_country',
            'id'
        );
    }
}

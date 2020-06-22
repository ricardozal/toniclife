<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'movement';

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'fk_id_product',
            'id'
        );
    }

}

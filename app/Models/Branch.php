<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'branch_has_products',
            'fk_id_branch',
            'fk_id_product'
        )->withPivot(['stock']);
    }

    public function address()
    {
        return $this->belongsTo(
            Address::class,
            'fk_id_address',
            'id'
        );
    }

}

<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function products()
    {
        return $this->hasMany(
            Product::class,
            'fk_id_category',
            'id'
        );
    }

}

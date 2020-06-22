<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function branches()
    {
        return $this->belongsToMany(
            Branch::class,
            'branch_has_products',
            'fk_id_product',
            'fk_id_branch'
        )->withPivot(['stock']);
    }

    public function country()
    {
        return $this->belongsTo(
            Country::class,
            'fk_id_country',
            'id'
        );
    }

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'fk_id_category',
            'id'
        );
    }

    public function movements()
    {
        return $this->hasMany(
            Movement::class,
            'fk_id_product',
            'id'
        );
    }

    public function reorderRequests()
    {
        return $this->belongsToMany(
            ReorderRequest::class,
            'reorder_request_product',
            'fk_id_product',
            'fk_id_reorder_request'
        )->withPivot(['quantity']);
    }

    public function orders()
    {
        return $this->belongsToMany(
            Order::class,
            'order_product',
            'fk_id_product',
            'fk_id_order'
        )->withPivot(['price','quantity']);
    }

}

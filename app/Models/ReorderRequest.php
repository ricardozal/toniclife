<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ReorderRequest extends Model
{
    protected $table = 'reorder_request';

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'reorder_request_product',
            'fk_id_reorder_request',
            'fk_id_product'
        )->withPivot(['quantity']);
    }

    public function distributor()
    {
        return $this->belongsTo(
            Distributor::class,
            'fk_id_distributor',
            'id'
        );
    }

    public function status()
    {
        return $this->belongsTo(
            ReorderRequestStatus::class,
            'fk_id_reorder_request_status',
            'id'
        );
    }

}

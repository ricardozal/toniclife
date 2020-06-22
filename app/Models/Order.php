<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

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
            OrderStatus::class,
            'fk_id_order_status',
            'id'
        );
    }

    public function shippingAddress()
    {
        return $this->belongsTo(
            Address::class,
            'fk_id_shipping_address',
            'id'
        );
    }

    public function branch()
    {
        return $this->belongsTo(
            Branch::class,
            'fk_id_branch',
            'id'
        );
    }

    public function paymentMethod()
    {
        return $this->belongsTo(
            PaymentMethod::class,
            'fk_id_payment_method',
            'id'
        );
    }


    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'order_product',
            'fk_id_order',
            'fk_id_product'
        )->withPivot(['price','quantity']);
    }

}

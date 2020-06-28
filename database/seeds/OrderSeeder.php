<?php
use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{

    public function run()
    {

        $product1 = \App\Models\Product::whereId(1)->first();
        $product2 = \App\Models\Product::whereId(2)->first();
        $product3 = \App\Models\Product::whereId(3)->first();
        $distributor = \App\Models\Distributor::whereId(1)->first();

        $totalPrice = ((($product1->distributor_price*2)+(($product1->country->tax_percentage*0.01)*($product1->distributor_price*2)))+
                      (($product2->distributor_price*2)+(($product2->country->tax_percentage*0.01)*($product2->distributor_price*2)))+
                      (($product3->distributor_price*2)+(($product3->country->tax_percentage*0.01)*($product3->distributor_price*2))));

        $totalTaxes =   (((($product1->country->tax_percentage*0.01)*($product1->distributor_price*2)))+
                        ((($product2->country->tax_percentage*0.01)*($product2->distributor_price*2)))+
                        ((($product3->country->tax_percentage*0.01)*($product3->distributor_price*2))));

        $points = ($product1->points*2)+($product2->points*2)+($product3->points*2);

        $orderId = DB::table('order')->insertGetId([
                'total_price'=>$totalPrice,
                'total_taxes'=>$totalTaxes,
                'total_accumulated_points'=>$points,
                'shipping_price'=>50,
                'fk_id_distributor'=>$distributor->id,
                'fk_id_order_status' => 1,
                'fk_id_shipping_address' => 1,
                'fk_id_branch' => 1,
                'fk_id_payment_method' => 1,
                'created_at'=>Carbon\Carbon::now()->toDateString()
        ]);

        $distributor->accumulated_points = $distributor->accumulated_points+$points;
        $distributor->save();

        DB::table('order_product')->insert([
            'price' => (($product1->distributor_price*2)+(($product1->country->tax_percentage*0.01)*($product1->distributor_price*2))),
            'quantity' => 2,
            'fk_id_product' => $product1->id,
            'fk_id_order' => $orderId
        ]);

        DB::table('order_product')->insert([
            'price' => (($product2->distributor_price*2)+(($product2->country->tax_percentage*0.01)*($product2->distributor_price*2))),
            'quantity' => 2,
            'fk_id_product' => $product2->id,
            'fk_id_order' => $orderId
        ]);

        DB::table('order_product')->insert([
            'price' => (($product3->distributor_price*2)+(($product3->country->tax_percentage*0.01)*($product3->distributor_price*2))),
            'quantity' => 2,
            'fk_id_product' => $product3->id,
            'fk_id_order' => $orderId
        ]);
    }

}

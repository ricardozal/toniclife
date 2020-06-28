<?php
use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{

    public function run()
    {
        DB::table('order')->insert([
            [
                'total_price'=>77.19,
                'total_taxes'=>2.52,
                'total_accumulated_points'=>541,
                'shipping_price'=>50,
                'fk_id_distributor'=>1,
                'fk_id_order_status' => 1,
                'fk_id_shipping_address' => 1,
                'fk_id_branch' => 1,
                'fk_id_payment_method' => 1,
                'created_at'=>Carbon\Carbon::now()->toDateString()



            ]
        ]);
    }

}

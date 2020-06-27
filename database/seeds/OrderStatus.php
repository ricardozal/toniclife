<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{

    public function run()
    {
        DB::table('order_status')->insert([
            'name'=> 'Pagado'

        ]);

        DB::table('order_status')->insert([
            'name'=> 'Entregado'

        ]);

        DB::table('order_status')->insert([
            'name'=> 'Cancelado'

        ]);
    }
}

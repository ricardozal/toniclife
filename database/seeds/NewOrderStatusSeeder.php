<?php

use \Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class NewOrderStatusSeeder extends Seeder
{

    public function run()
    {
        DB::table('order_status')->insert([
            'name'=> 'Pendiente'

        ]);

        DB::table('order_status')->insert([
            'name'=> 'Autorizado'

        ]);
    }
}

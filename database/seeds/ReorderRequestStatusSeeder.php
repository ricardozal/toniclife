<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReorderRequestStatusSeeder extends Seeder
{

    public function run()
    {
        DB::table('reorder_request_status')->insert([
            'name'=> 'Petición enviada'

        ]);

        DB::table('reorder_request_status')->insert([
            'name'=> 'Entregado en matriz'

        ]);


    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{

    public function run()
    {
        DB::table('country')->insert([
            'name'=> 'Mexico',
            'tax_percentage'=> 16
        ]);

        DB::table('country')->insert([
            'name'=> 'EstadosUnidos',
            'tax_percentage'=> 10.5
        ]);
    }
}

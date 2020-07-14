<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{

    public function run()
    {
        DB::table('country')->insert([
            'name'=> 'México',
            'tax_percentage'=> 16
        ]);

        DB::table('country')->insert([
            'name'=> 'Estados Unidos',
            'tax_percentage'=> 10.5
        ]);
    }
}

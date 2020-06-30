<?php

use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class BranchHasProductsSeeder extends Seeder
{
    public function run()
    {
        DB::table('branch_has_products')->insert([
            'stock'=>5,
            'fk_id_product'=>1,
            'fk_id_branch'=>1,
        ]);

        DB::table('branch_has_products')->insert([
            'stock'=>5,
            'fk_id_product'=>2,
            'fk_id_branch'=>1,
        ]);

        DB::table('branch_has_products')->insert([
            'stock'=>5,
            'fk_id_product'=>3,
            'fk_id_branch'=>1,
        ]);
    }
}

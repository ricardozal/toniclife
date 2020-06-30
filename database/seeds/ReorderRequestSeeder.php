<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReorderRequestSeeder extends Seeder
{

    public function run()
    {
        $product1 = \App\Models\Product::whereId(1)->first();
        $product2 = \App\Models\Product::whereId(2)->first();
        $distributor = \App\Models\Distributor::whereId(1)->first();

        $reorderId = DB::table('reorder_request')->insertGetId([
            'fk_id_distributor'=> 1,
            'fk_id_reorder_request_status'=>1,
            'created_at'=>Carbon\Carbon::now()->toDateString()

        ]);

        DB::table('reorder_request_product')->insert([
            'quantity' => 2,
            'fk_id_product' => $product1->id,
            'fk_id_reorder_request' => $reorderId
        ]);

        DB::table('reorder_request_product')->insert([
            'quantity' => 2,
            'fk_id_product' => $product2->id,
            'fk_id_reorder_request' => $reorderId
        ]);




    }
}

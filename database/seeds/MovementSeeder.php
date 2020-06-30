<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class MovementSeeder extends Seeder
{

    public function run()
    {
        DB::table('movement')->insert([
            'comment'=>'Comentario de prueba uno',
            'type'=>true,
            'quantity'=>2,
            'fk_id_product'=>1
        ]);

        DB::table('movement')->insert([
            'comment'=>'Comentario de prueba dos',
            'type'=>false,
            'quantity'=>2,
            'fk_id_product'=>2
        ]);
    }
}

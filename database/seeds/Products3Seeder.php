<?php
use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class Products3Seeder extends Seeder
{

    public function run()
    {
        DB::table('product')->insert([
            [
                'code'=>'6821',
                'name'=>'FORMULA COLOIDAL SPRAY',
                'image_url'=>'products/6821.jpg',
                'distributor_price'=>180,
                'points'=>180,
                'fk_id_country' => 2,


            ]
        ]);
    }

}

<?php

use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        DB::table('product')->insert([
            [
                'code'=>'8753',
                'name'=>'PP 200 G TE',
                'image_url'=>'products/8753.jpg',
                'distributor_price'=>180,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9972',
                'name'=>'PROTEINA AISLADA DE SOYA 500 G',
                'image_url'=>'products/9972.jpg',
                'distributor_price'=>445.00,
                'points'=>445,
                'fk_id_country' => 1,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'9965',
                'name'=>'PROTEINA SUERO DE LECHE 500 G',
                'image_url'=>'products/9965.jpg',
                'distributor_price'=>445.00 ,
                'points'=>445,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8975',
                'name'=>'RELIFE 200 G TE',
                'image_url'=>'products/.jpg',
                'distributor_price'=>180.00,
                'points'=>180,
                'fk_id_country' => 1,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8609',
                'name'=>'RELIFE 250 ML',
                'image_url'=>'products/8609.jpg',
                'distributor_price'=>180.17,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8708',
                'name'=>'R-TONIC 200 G TE',
                'image_url'=>'products/8708.jpg',
                'distributor_price'=>180.00,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8197',
                'name'=>'TONIC 60 CAPS',
                'image_url'=>'products/8197.jpg',
                'distributor_price'=>180.17,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9422',
                'name'=>'SHAKE CAPUCHINO 625 G',
                'image_url'=>'products/9422.jpg',
                'distributor_price'=>232.76,
                'points'=>233,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8234',
                'name'=>'SHAKE CHOCOLATE 625 G',
                'image_url'=>'products/8234.jpg',
                'distributor_price'=>232.76,
                'points'=>233,
                'fk_id_country' => 1,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'9712',
                'name'=>'24 SHAKE FRESA 625 G',
                'image_url'=>'products/9712.jpg',
                'distributor_price'=>232.76,
                'points'=>233,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9408',
                'name'=>'24 SHAKE GALLETA 625 G',
                'image_url'=>'products/9408.jpg',
                'distributor_price'=>232.76,
                'points'=>233,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9415',
                'name'=>'SHAKE PIÑA COLADA 625 G',
                'image_url'=>'products/9415.jpg',
                'distributor_price'=>232.76,
                'points'=>233,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9705',
                'name'=>'24 SHAKE VAINILLA 625 G',
                'image_url'=>'products/9705.jpg',
                'distributor_price'=>232.76,
                'points'=>233,
                'fk_id_country' => 1,


            ]
        ]);
        DB::table('product')->insert([
            [
                'code'=>'8562',
                'name'=>'S0 30 CAPS',
                'image_url'=>'products/8562.jpg',
                'distributor_price'=>261.21,
                'points'=>261,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9361',
                'name'=>'SALVADO DE TRIGO (TOSTADO) 500 G',
                'image_url'=>'products/9361.jpg',
                'distributor_price'=>30.00,
                'points'=>0,
                'fk_id_country' => 1,


            ]
        ]);
        DB::table('product')->insert([
            [
                'code'=>'8807',
                'name'=>'THAI SHI 30 CAPS',
                'image_url'=>'products/.jpg',
                'distributor_price'=>246.20,
                'points'=>246,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8869M',
                'name'=>'TBC-SOBRE C/ 3 CAPS',
                'image_url'=>'products/8869M.jpg',
                'distributor_price'=>37.93,
                'points'=>38,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8869',
                'name'=>'TBC 30 CAPS',
                'image_url'=>'products/8869.jpg',
                'distributor_price'=>374.14,
                'points'=>374,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8364',
                'name'=>'TLAMAT REFORZADO CON LACTOBACILOS 240 ML',
                'image_url'=>'products/8364.jpg',
                'distributor_price'=>357.76,
                'points'=>358,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9248-2',
                'name'=>'TEA D-TOX PAQUETE C/2 SOB',
                'image_url'=>'products/9248-2.jpg',
                'distributor_price'=>315.00,
                'points'=>294,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9248-4',
                'name'=>'TEA D-TOX PAQUETE C/4 SOB',
                'image_url'=>'products/9248-4.jpg',
                'distributor_price'=>588.00,
                'points'=>588,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9248',
                'name'=>'TEA D-TOX SOBRE C/12 G',
                'image_url'=>'products/9248.jpg',
                'distributor_price'=>168.00,
                'points'=>147,
                'fk_id_country' => 1,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'8746',
                'name'=>'TONIC BRON 200 G TE',
                'image_url'=>'products/8746.jpg',
                'distributor_price'=>180.00,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'8739',
                'name'=>'TONIC CLEAN 200 G TE',
                'image_url'=>'products/.jpg',
                'distributor_price'=>180.00,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8043',
                'name'=>'TONIC CLEAN 500ML',
                'image_url'=>'products/8043.jpg',
                'distributor_price'=>374.14,
                'points'=>374,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8647',
                'name'=>'TONIC CLEAN 60 CAPS',
                'image_url'=>'products/8647.jpg',
                'distributor_price'=>261.21,
                'points'=>261,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8012',
                'name'=>'TONIC LIFE 500 ML',
                'image_url'=>'products/8012.jpg',
                'distributor_price'=>374.14,
                'points'=>374,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8081',
                'name'=>'VITA BOYS 500 ML',
                'image_url'=>'products/8081.jpg',
                'distributor_price'=>180.17,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9996',
                'name'=>'VQ 100 TAB',
                'image_url'=>'products/9996.jpg',
                'distributor_price'=>357.76,
                'points'=>358,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8524',
                'name'=>'X-PRO SHAKE TL 500 G',
                'image_url'=>'products/8524.jpg',
                'distributor_price'=>383.62,
                'points'=>384,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8203M',
                'name'=>'ZUCA GOLD-SOBRE C/ 3 CAPS',
                'image_url'=>'products/8203M.jpg',
                'distributor_price'=>10.34,
                'points'=>10,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8715',
                'name'=>'ZUCA GOLD 200 G TE',
                'image_url'=>'products/8715.jpg',
                'distributor_price'=>180.00,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8616',
                'name'=>'ZUCA GOLD 500 ML',
                'image_url'=>'products/8616.jpg',
                'distributor_price'=>212.93,
                'points'=>213,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8203',
                'name'=>'ZUCA GOLD 60 CAPS',
                'image_url'=>'products/8203.jpg',
                'distributor_price'=>180.17,
                'points'=>180,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'KBM01',
                'name'=>'KIT DE INSCRIPCIÓN - BASICO -',
                'image_url'=>'products/KBM01.jpg',
                'distributor_price'=>1100.00,
                'is_kit' => true,
                'points'=>0,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'KCPF',
                'name'=>'KIT DE INSCRIPCIÓN - CLIENTE PREFERENTE -',
                'image_url'=>'products/KCPF.jpg',
                'distributor_price'=>500.00,
                'is_kit' => true,
                'points'=>0,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'KPM01',
                'name'=>'KIT DE INSCRIPCIÓN - PREMIUM -',
                'image_url'=>'products/KPM01.jpg',
                'distributor_price'=>5500.00,
                'is_kit' => true,
                'points'=>0,
                'fk_id_country' => 1,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'8420',
                'name'=>'KIT DE INSCRIPCIÓN - D-TOX -',
                'image_url'=>'products/KPM01.jpg',
                'distributor_price'=>1100.00,
                'is_kit' => true,
                'points'=>0,
                'fk_id_country' => 1,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'2311',
                'name'=>'24 SHAKE CAPPUCCINO (ENERLIFE)',
                'image_url'=>'products/2311.jpg',
                'distributor_price'=>24.61,
                'points'=>42,
                'fk_id_country' => 2,


            ]
        ]);



        DB::table('product')->insert([
            [
                'code'=>'6739',
                'name'=>'24 SHAKE CHOCOLATE (ENERLIFE)',
                'image_url'=>'products/6739.jpg',
                'distributor_price'=>24.61,
                'points'=>42,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5342',
                'name'=>'24 SHAKE FRESA (ENERLIFE)',
                'image_url'=>'products/5342.jpg',
                'distributor_price'=>24.61,
                'points'=>42,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'5298',
                'name'=>'24 SHAKE GALLETA (ENERLIFE)',
                'image_url'=>'products/5298.jpg',
                'distributor_price'=>24.61,
                'points'=>42,
                'fk_id_country' => 2,


            ]
        ]);



        DB::table('product')->insert([
            [
                'code'=>'5304',
                'name'=>'24 SHAKE PIÑA COLADA (ENERLIFE)',
                'image_url'=>'products/5304.jpg',
                'distributor_price'=>24.61,
                'points'=>42,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'5335',
                'name'=>'24 SHAKE VAINILLA (ENERLIFE)',
                'image_url'=>'products/5335.jpg',
                'distributor_price'=>24.61,
                'points'=>42,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'6456',
                'name'=>'ABILTIY',
                'image_url'=>'products/6456.jpg',
                'distributor_price'=>58.85,
                'points'=>94,
                'fk_id_country' => 2,


            ]
        ]);



        DB::table('product')->insert([
            [
                'code'=>'M012',
                'name'=>'ABILTIY - 3 CAPS-',
                'image_url'=>'products/M012.jpg',
                'distributor_price'=>6.42,
                'points'=>12,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'6890',
                'name'=>'ABY LIFE 60 CAPS',
                'image_url'=>'products/6890.jpg',
                'distributor_price'=>17.6,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8692',
                'name'=>'ABY LIFE TE 200 G',
                'image_url'=>'products/8692.jpg',
                'distributor_price'=>17.12,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'5052',
                'name'=>'ABY LIFE TONICO',
                'image_url'=>'products/5052.jpg',
                'distributor_price'=>23.54,
                'points'=>46,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6678',
                'name'=>'BABA DE CARACOL 150 GR',
                'image_url'=>'products/6678.jpg',
                'distributor_price'=>23.54,
                'points'=>46,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'5250',
                'name'=>'BP & SIZE 0 30 CAPS',
                'image_url'=>'products/5250.jpg',
                'distributor_price'=>38.52,
                'points'=>63,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8357',
                'name'=>'BRONIX COUGH SYRUP 240 ML',
                'image_url'=>'products/8357.jpg',
                'distributor_price'=>17.12,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8371',
                'name'=>'CATALOGO',
                'image_url'=>'products/8371.jpg',
                'distributor_price'=>2.14,
                'points'=>2,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'5038',
                'name'=>'CINERARIA MARITIMA 20 ML',
                'image_url'=>'products/5038.jpg',
                'distributor_price'=>9.416,
                'points'=>18,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5243',
                'name'=>'COLAGENO 30 CAPS',
                'image_url'=>'products/5243.jpg',
                'distributor_price'=>18.19,
                'points'=>36,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'5267',
                'name'=>'COLAGENO MALTEADA BLUE BERRY',
                'image_url'=>'products/5267.jpg',
                'distributor_price'=>33.17,
                'points'=>64,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'5274',
                'name'=>'COLAGENO MALTEADA FRUTAS TROPICALES',
                'image_url'=>'products/5274.jpg',
                'distributor_price'=>33.17,
                'points'=>64,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'5151',
                'name'=>'COLAGENO TONIC LIFE 120 CAPS',
                'image_url'=>'products/5151.jpg',
                'distributor_price'=>47.08,
                'points'=>84,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'8661M',
                'name'=>'COURE TONIC -SOBRE 3 CAPS-',
                'image_url'=>'products/8661M.jpg',
                'distributor_price'=>1.605,
                'points'=>3,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'6937',
                'name'=>'COURE TONIC 60 CAPS',
                'image_url'=>'products/6937.jpg',
                'distributor_price'=>17.12,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6654',
                'name'=>'DONNA LIFE 60 CAPS',
                'image_url'=>'products/6654.jpg',
                'distributor_price'=>17.12,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);



        DB::table('product')->insert([
            [
                'code'=>'8210M',
                'name'=>'ENERGY GOLD -SOBRE 3 CAPS-',
                'image_url'=>'products/8210M.jpg',
                'distributor_price'=>2.14,
                'points'=>4,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'6722',
                'name'=>'ENERGY GOLD 30 CAPS',
                'image_url'=>'products/6722.jpg',
                'distributor_price'=>19.26,
                'points'=>38,
                'fk_id_country' => 2,


            ]
        ]);




        DB::table('product')->insert([
            [
                'code'=>'6906',
                'name'=>'FEBLIFE ',
                'image_url'=>'products/6906.jpg',
                'distributor_price'=>17.12,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);

    }
}

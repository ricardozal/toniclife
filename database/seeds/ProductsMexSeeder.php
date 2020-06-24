<?php

use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ProductsMexSeeder extends Seeder
{
    public function run()
    {
        DB::table('product')->insert([
            'code'=>'8784',
            'name'=>'ABY LIFE 500 ML',
            'image_url'=>'products/8784.jpg',
            'distributor_price'=>244.83,
            'points'=>245,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8692',
            'name'=>'ABY LIFE 200 G TE',
            'image_url'=>'products/8692.jpg',
            'distributor_price'=>180.00,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8623',
            'name'=>'ABY LIFE 60 CAPS',
            'image_url'=>'products/8623.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9385',
            'name'=>'AMARANTO 200 G',
            'image_url'=>'products/9385.jpg',
            'distributor_price'=>36.00,
            'points'=>0,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9439',
            'name'=>'AVENA 300 G',
            'image_url'=>'products/9439.jpg',
            'distributor_price'=>36.00,
            'points'=>0,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9378',
            'name'=>'AZUCAR MASCABADO 500 G',
            'image_url'=>'products/9378.jpg',
            'distributor_price'=>36.00,
            'points'=>0,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8166',
            'name'=>'BABA DE CARACOL 150 G',
            'image_url'=>'products/8166.jpg',
            'distributor_price'=>231.03,
            'points'=>231,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9200',
            'name'=>'BP & S0 30 CAPS',
            'image_url'=>'products/9200.jpg',
            'distributor_price'=>405.17,
            'points'=>405,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8340',
            'name'=>'BRONIX REFORZADO CON JENGIBRE 240 ML',
            'image_url'=>'products/8340.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8760',
            'name'=>'CINERARIA MARITIMA 20 ML',
            'image_url'=>'products/8760.jpg',
            'distributor_price'=>90.52,
            'points'=>91,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9224BB',
            'name'=>'COLAGENO BLUE BERRY 400 G',
            'image_url'=>'products/9224BB.jpg',
            'distributor_price'=>332.76,
            'points'=>333,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9224FT',
            'name'=>'COLAGENO FRUTAS TROPICALES 400 G',
            'image_url'=>'products/9224FT.jpg',
            'distributor_price'=>332.76,
            'points'=>333,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9194',
            'name'=>'COLAGENO 30 CAPS',
            'image_url'=>'products/9194.jpg',
            'distributor_price'=>167.24,
            'points'=>167,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8661M',
            'name'=>'COURE TONIC - SOBRE C/3 CAPS',
            'image_url'=>'products/8661M.jpg',
            'distributor_price'=>10.34,
            'points'=>10,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8661',
            'name'=>'COURE TONIC 60 CAPS',
            'image_url'=>'products/8661.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8142',
            'name'=>'DONNA LIFE 60 CAPS',
            'image_url'=>'products/8142.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8210M',
            'name'=>'ENERGY GOLD - SOBRE C/3 CAPS',
            'image_url'=>'products/8210M.jpg',
            'distributor_price'=>19.83,
            'points'=>20,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8210',
            'name'=>'ENERGY GOLD 30 CAPS',
            'image_url'=>'products/8210.jpg',
            'distributor_price'=>200.86,
            'points'=>201,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8630',
            'name'=>'FEB-LIFE 60 CAPS',
            'image_url'=>'products/8630.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8074',
            'name'=>'FORMULA COLOIDAL - SOLUCION - 240 ML',
            'image_url'=>'products/8074.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8548',
            'name'=>'FORMULA COLOIDAL - SPRAY - 240 ML',
            'image_url'=>'products/8548.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8791',
            'name'=>'FORMULA COLOIDAL SPRAY 80 ML',
            'image_url'=>'products/8791.jpg',
            'distributor_price'=>85.00,
            'points'=>85,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8500',
            'name'=>'FORMULA COLOIDAL GEL 150 ML',
            'image_url'=>'products/8500.jpg',
            'distributor_price'=>129.32,
            'points'=>129,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8173',
            'name'=>'G-DOL GEL 250 G $ 165.52',
            'image_url'=>'products/8173.jpg',
            'distributor_price'=>165.52,
            'points'=>166,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8159',
            'name'=>'G&C 60 CAPS $ 268.97',
            'image_url'=>'products/8159.jpg',
            'distributor_price'=>268.97,
            'points'=>269,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9989',
            'name'=>'GANFICOL 60 CAPS',
            'image_url'=>'products/9989.jpg',
            'distributor_price'=>357.76,
            'points'=>358,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9781',
            'name'=>'GUBI SHAKE SPORT VAINILLA 625 G',
            'image_url'=>'products/9781.jpg',
            'distributor_price'=>330.17,
            'points'=>330,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8883',
            'name'=>'GUBI SHAKE SPORT FRESA 625 G',
            'image_url'=>'products/8883.jpg',
            'distributor_price'=>330.17,
            'points'=>330,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9071',
            'name'=>'HAIR TONIC SHAMPOO 350 G',
            'image_url'=>'products/9071.jpg',
            'distributor_price'=>187.93,
            'points'=>188,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9873',
            'name'=>'HIDRA ENERGY LIFE CAJA C/30 SOB',
            'image_url'=>'products/9873.jpg',
            'distributor_price'=>462.00,
            'points'=>462,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9929',
            'name'=>'HOUTH 90 CAPS',
            'image_url'=>'products/9929.jpg',
            'distributor_price'=>487.93,
            'points'=>488,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9910',
            'name'=>'HOUTH CREMA 45 G',
            'image_url'=>'products/9910.jpg',
            'distributor_price'=>462.07,
            'points'=>462,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9736',
            'name'=>'JABIL CREMA 60 G',
            'image_url'=>'products/9736.jpg',
            'distributor_price'=>231.03,
            'points'=>231,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'7084',
            'name'=>'JAPI BIT 90 PERLAS (70 G) - MIEL Y ALGA ESPIRULINA',
            'image_url'=>'products/7084.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'7091',
            'name'=>'JAPI BIT 90 PERLAS (70 G ) - MIEL Y EUCALIPTO',
            'image_url'=>'products/7091.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'7107',
            'name'=>'JAPI BIT 90 PERLAS (70 G) - MIEL Y HOJA SEN',
            'image_url'=>'products/7107.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'7114',
            'name'=>'JAPI BIT 90 PERLAS (70 G ) - MIEL Y PROPOLEO',
            'image_url'=>'products/7114.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9019M',
            'name'=>'JIMMY COFFEE SOBRE C/12 G',
            'image_url'=>'products/9019M.jpg',
            'distributor_price'=>18.00,
            'points'=>18,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9309',
            'name'=>'JIMMY COFFEE CAJA C/10 SOB.',
            'image_url'=>'products/9309.jpg',
            'distributor_price'=>169.00,
            'points'=>169,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9019',
            'name'=>'JIMMY COFFEE 230 G',
            'image_url'=>'products/9019.jpg',
            'distributor_price'=>292.00,
            'points'=>292,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9019-1',
            'name'=>'JIMMY COFFEE 230 G. ADICIONADO C/ COENZIMA Q10',
            'image_url'=>'products/9019-1.jpg',
            'distributor_price'=>323.00,
            'points'=>323,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9316',
            'name'=>'LECHE DE SOYA 500 G',
            'image_url'=>'products/9316.jpg',
            'distributor_price'=>48.00,
            'points'=>0,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8722',
            'name'=>'LEG LINE 200 G TE',
            'image_url'=>'products/8722.jpg',
            'distributor_price'=>180.00,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8296',
            'name'=>'LEGLINE 60 CAPS',
            'image_url'=>'products/8296.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8050M',
            'name'=>'LEXI LIFE - SOBRE C/3 CAPS',
            'image_url'=>'products/8050M.jpg',
            'distributor_price'=>13.79,
            'points'=>14,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8050',
            'name'=>'LEXI LIFE 60 CAPS',
            'image_url'=>'products/8050.jpg',
            'distributor_price'=>279.31,
            'points'=>279,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8241',
            'name'=>'LEXI LIFE FIBRA 500 G',
            'image_url'=>'products/8241.jpg',
            'distributor_price'=>244.83,
            'points'=>245,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8111',
            'name'=>'LEXI LIFE GEL 250 G',
            'image_url'=>'products/8111.jpg',
            'distributor_price'=>189.66,
            'points'=>190,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'6296M',
            'name'=>'MANGO LIFE - SOBRE C/3 CAPS',
            'image_url'=>'products/6296M.jpg',
            'distributor_price'=>39.66,
            'points'=>40,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'6296',
            'name'=>'MANGO LIFE 30 CAPS',
            'image_url'=>'products/6296.jpg',
            'distributor_price'=>405.17,
            'points'=>405,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8951',
            'name'=>'MOVARTIC 36 CAPS',
            'image_url'=>'products/8951.jpg',
            'distributor_price'=>267.24,
            'points'=>267,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8180M',
            'name'=>'NERLIFE - SOBRE C/3 CAPS',
            'image_url'=>'products/8180M.jpg',
            'distributor_price'=>10.34,
            'points'=>10,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8180',
            'name'=>'NERLIFE 60 CAPS',
            'image_url'=>'products/8180.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8555',
            'name'=>'NOPI ALOE 500ML',
            'image_url'=>'products/8555.jpg',
            'distributor_price'=>214.66,
            'points'=>215,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8654',
            'name'=>'O 3,6,9 60 CAPS',
            'image_url'=>'products/8654.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8302',
            'name'=>'OCAL 60 CAPS',
            'image_url'=>'products/8302.jpg',
            'distributor_price'=>212.93,
            'points'=>213,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9750',
            'name'=>'OS 436 - 30 TABLETAS',
            'image_url'=>'products/9750.jpg',
            'distributor_price'=>268.97,
            'points'=>269,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'9570M',
            'name'=>'OS 436 - SOBRE C/3 TABS',
            'image_url'=>'products/9570M.jpg',
            'distributor_price'=>26.72,
            'points'=>27,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8098',
            'name'=>'OXIFILA 500 ML',
            'image_url'=>'products/8098.jpg',
            'distributor_price'=>357.76,
            'points'=>358,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8593',
            'name'=>'OXIMAGIC 250 ML',
            'image_url'=>'products/8593.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8838',
            'name'=>'P MIN 30 CAPS',
            'image_url'=>'products/8838.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8265',
            'name'=>'PASTRILIFE 60 CAPS',
            'image_url'=>'products/8265.jpg',
            'distributor_price'=>180.17,
            'points'=>180,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8777',
            'name'=>'POLEO GOTAS 20 ML',
            'image_url'=>'products/8777.jpg',
            'distributor_price'=>57.76,
            'points'=>58,
            'fk_id_country'=>1
        ]);

        DB::table('product')->insert([
            'code'=>'8579',
            'name'=>'PP 1 TAB',
            'image_url'=>'products/8579.jpg',
            'distributor_price'=>118.97,
            'points'=>119,
            'fk_id_country'=>1
        ]);


    }
}

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
                'distributor_price'=>17.12,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'6661',
                'name'=>'G & C 60 TAB',
                'image_url'=>'products/6661.jpg',
                'distributor_price'=>26.75,
                'points'=>54,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6685',
                'name'=>'G DOL 250 GR',
                'image_url'=>'products/6685.jpg',
                'distributor_price'=>18.19,
                'points'=>36,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5458',
                'name'=>'GANFICOL 60 CAPS',
                'image_url'=>'products/5458.jpg',
                'distributor_price'=>34.24,
                'points'=>56,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8678',
                'name'=>'GINKGO TONIC 60 CAPS',
                'image_url'=>'products/8678.jpg',
                'distributor_price'=>17.12,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8906',
                'name'=>'GUBI SHAKE 625 GR',
                'image_url'=>'products/8906.jpg',
                'distributor_price'=>32.1,
                'points'=>64,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5144',
                'name'=>'HAIR TONIC SHAMPOO 350 ML',
                'image_url'=>'products/5144.jpg',
                'distributor_price'=>20.33,
                'points'=>40,
                'fk_id_country' => 2,


            ]
        ]);


        DB::table('product')->insert([
            [
                'code'=>'8852',
                'name'=>'HEMORRIS CURE 45G',
                'image_url'=>'products/8852.jpg',
                'distributor_price'=>19.26,
                'points'=>38,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5380',
                'name'=>'HIDRA ENERGY LIFE 30 SOB',
                'image_url'=>'products/5380.jpg',
                'distributor_price'=>42.8,
                'points'=>942,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5427',
                'name'=>'HOUTH 90 CAPS',
                'image_url'=>'products/5427.jpg',
                'distributor_price'=>53.5,
                'points'=>1177,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5403',
                'name'=>'HOUTH CREMA 45 GR.',
                'image_url'=>'products/5403.jpg',
                'distributor_price'=>42.8,
                'points'=>942,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9928',
                'name'=>'HOUTH LOCION',
                'image_url'=>'products/9928.jpg',
                'distributor_price'=>22.47,
                'points'=>494,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5359',
                'name'=>'JABIL CREMA 60 GR',
                'image_url'=>'products/5359.jpg',
                'distributor_price'=>23.54,
                'points'=>518,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9019',
                'name'=>'JIMMY COFFEE -SOBRE O.42 Oz -',
                'image_url'=>'products/9019.jpg',
                'distributor_price'=>2.14,
                'points'=>47,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5281',
                'name'=>'JIMMY COFFEE 10 SOBRES',
                'image_url'=>'products/5281.jpg',
                'distributor_price'=>16.05,
                'points'=>353,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5120',
                'name'=>'JIMMY COFFEE 230 gr/ 8.11 oz',
                'image_url'=>'products/5120.jpg',
                'distributor_price'=>27.82,
                'points'=>612,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6784',
                'name'=>'LEG LINE 60 CAPS',
                'image_url'=>'products/6784.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8050M',
                'name'=>'LEXI LIFE -SOBRE 3 CAPS-',
                'image_url'=>'products/8050M.jpg',
                'distributor_price'=>1.605,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'7593',
                'name'=>'LEXI LIFE 60 CAPS',
                'image_url'=>'products/7593.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8241',
                'name'=>'LEXI LIFE FIBER 500 GR',
                'image_url'=>'products/8241.jpg',
                'distributor_price'=>24.61,
                'points'=>541,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6630',
                'name'=>'LEXI LIFE GEL 250 GR',
                'image_url'=>'products/6630.jpg',
                'distributor_price'=>20.33,
                'points'=>447,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5373',
                'name'=>'LEXI LIFE MAX 60 CAPS',
                'image_url'=>'products/5373.jpg',
                'distributor_price'=>29.96,
                'points'=>659,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6296M',
                'name'=>'MANGO LIFE -SOBRE 3 CAPS-',
                'image_url'=>'products/6296M.jpg',
                'distributor_price'=>3.745,
                'points'=>82,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6562',
                'name'=>'MANGO LIFE 30 CAPS',
                'image_url'=>'products/6562.jpg',
                'distributor_price'=>38.52,
                'points'=>847,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8180M',
                'name'=>'NER-LIFE -SOBRE 3 CAPS-',
                'image_url'=>'products/8180M.jpg',
                'distributor_price'=>1.605,
                'points'=>35,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6692',
                'name'=>'NERLIFE 60 CAPS (NERVIFIN)',
                'image_url'=>'products/6692.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6838',
                'name'=>'NOPIALOE 500ML',
                'image_url'=>'products/6838.jpg',
                'distributor_price'=>20.33,
                'points'=>447,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6791',
                'name'=>'O CAL 60 CAPS (OSEO CAL)',
                'image_url'=>'products/6791.jpg',
                'distributor_price'=>20.33,
                'points'=>447,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9570',
                'name'=>'O S 436 - SOBRE 3 TABS-',
                'image_url'=>'products/9570.jpg',
                'distributor_price'=>3.21,
                'points'=>71,
                'fk_id_country' => 2,


            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'9750',
                'name'=>'O S 436 30 CAPS',
                'image_url'=>'products/9750.jpg',
                'distributor_price'=>26.75,
                'points'=>589,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8654M',
                'name'=>'O,3,6,9 -SOBRE 3 CAPS-',
                'image_url'=>'products/8654M.jpg',
                'distributor_price'=>1.605,
                'points'=>35,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6920',
                'name'=>'O,3,6,9 60 CAPS',
                'image_url'=>'products/6920.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6623',
                'name'=>'OXIFILA 500 ML',
                'image_url'=>'products/6623.jpg',
                'distributor_price'=>35.31,
                'points'=>777,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6869',
                'name'=>'OXIMAGIC 250 ML',
                'image_url'=>'products/6869.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5069',
                'name'=>'PMIN 30 CAPS (PROSTMIN)',
                'image_url'=>'products/5069.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6852',
                'name'=>'PP 1 TAB',
                'image_url'=>'products/6852.jpg',
                'distributor_price'=>10.7,
                'points'=>235,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5441',
                'name'=>'PROTEINA AISLADA DE SOYA 500 GR',
                'image_url'=>'products/5441.jpg',
                'distributor_price'=>41.73,
                'points'=>918,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5434',
                'name'=>'PROTEINA SUERO DE LECHE 500 GR',
                'image_url'=>'products/5434.jpg',
                'distributor_price'=>41.73,
                'points'=>918,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6708',
                'name'=>'R-TONIC 60 CAPS',
                'image_url'=>'products/6708.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6876',
                'name'=>'RELIFE 250 ML (RELAXIM)',
                'image_url'=>'products/6876.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6845',
                'name'=>'SIZE CERO 30 CAPS',
                'image_url'=>'products/6845.jpg',
                'distributor_price'=>25.68,
                'points'=>565,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8869M',
                'name'=>'TBC -SOBRE 3 CAPS-',
                'image_url'=>'products/8869M.jpg',
                'distributor_price'=>3.745,
                'points'=>82,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5090',
                'name'=>'TBC 30 CAPS',
                'image_url'=>'products/5090.jpg',
                'distributor_price'=>35.31,
                'points'=>777,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8746',
                'name'=>'TE # 1 - R-TONIC 200 G',
                'image_url'=>'products/8746.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8715',
                'name'=>'TE # 2 - ZUCAGOLD 200 G',
                'image_url'=>'products/8715.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8722',
                'name'=>'TE # 3 - LEGLINE 200 G',
                'image_url'=>'products/8722.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8739',
                'name'=>'TE # 4 - TONIC CLEAN 200 G',
                'image_url'=>'products/8739.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8746',
                'name'=>'TE # 5 - TONIC BRON 200 G',
                'image_url'=>'products/8746.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8753',
                'name'=>'TE # 6 - IMPOTENCIA 200 G',
                'image_url'=>'products/8753.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8975',
                'name'=>'TE # 7 - RELIFE 200 GR',
                'image_url'=>'products/8975.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8432',
                'name'=>'TLAMAT (LACTOBACILLUS) 240 ML',
                'image_url'=>'products/8432.jpg',
                'distributor_price'=>34.24,
                'points'=>753,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6913',
                'name'=>'TONIC CLEAN 60 CAPS',
                'image_url'=>'products/6913.jpg',
                'distributor_price'=>35.31,
                'points'=>777,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6586',
                'name'=>'TONIC CLEAN 500ML',
                'image_url'=>'products/6586.jpg',
                'distributor_price'=>35.31,
                'points'=>777,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'4579',
                'name'=>'TONIC LIFE 500ML',
                'image_url'=>'products/4579.jpg',
                'distributor_price'=>35.31,
                'points'=>777,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5106',
                'name'=>'TONIC LIFE 60 CAPS',
                'image_url'=>'products/5106.jpg',
                'distributor_price'=>35.31,
                'points'=>777,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6777',
                'name'=>'VEGGY DIET 454 GR',
                'image_url'=>'products/6777.jpg',
                'distributor_price'=>22.47,
                'points'=>494,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6616',
                'name'=>'VITABOYS 500ML ',
                'image_url'=>'products/6616.jpg',
                'distributor_price'=>17.12,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'5465',
                'name'=>'VQ-TONIC C/100 TABLETAS ',
                'image_url'=>'products/5465.jpg',
                'distributor_price'=>34.24,
                'points'=>753,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6715',
                'name'=>'ZUCA GOLD 60 CAPS',
                'image_url'=>'products/6715.jpg',
                'distributor_price'=>17.25,
                'points'=>377,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'8203M',
                'name'=>'ZUCA GOLD -SOBRE 3 CAPS-',
                'image_url'=>'products/8203M.jpg',
                'distributor_price'=>1.605,
                'points'=>35,
                'fk_id_country' => 2,

            ]
        ]);

        DB::table('product')->insert([
            [
                'code'=>'6883',
                'name'=>'ZUCA GOLD TONICO 500 ML',
                'image_url'=>'products/6883.jpg',
                'distributor_price'=>20.33,
                'points'=>447,
                'fk_id_country' => 2,

            ]
        ]);





    }

}

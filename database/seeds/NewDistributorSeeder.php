<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewDistributorSeeder extends Seeder
{
    public $faker;

    public function run()
    {
        $this->faker = Faker\Factory::create();
        if (env('APP_DEBUG')) {
            $this->newDistributor();
        }
    }

    public function newDistributor()
    {

        $idAddress = DB::table('address')->insertGetId([
            'street' => $this->faker->streetName,
            'zip_code' => $this->faker->numberBetween(5000, 6000),
            'ext_num' => $this->faker->numberBetween(100, 500),
            'colony' => $this->faker->streetSuffix,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'fk_id_country' => 1
        ]);

        $id = DB::table('new_distributor')->insertGetId([
            'name'=> 'Juan Perez',
            'email'=> 'juan@toniclife.com.mx',
            'marital_status'=>'soltero',
            'birthday'=>'1990-07-15',
            'birth_place'=>'Mexico',
            'nationality'=>'Mexicano',
            'rfc_or_itin'=>'JUPE900715H',
            'curp_or_ssn'=>'JUPE900715HMCNCS06',
            'phone_1'=>'7896548256',
            'phone_2'=>'7896548255',
            'no_official_identification'=>'NA',
            'fk_id_address'=>$idAddress,
            'fk_id_order'=>2
        ]);

        DB::table('data_bank')->insert([
            'bank_name' => 'CityBanamex',
            'account_name' => 'Juan Perez',
            'bank_account_number' => '4242424242424242',
            'clabe_routing_bank' => '1524895475',
            'fk_id_new_distributor' => $id
        ]);

    }

}

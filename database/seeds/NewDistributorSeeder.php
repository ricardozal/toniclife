<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewDistributorSeeder extends Seeder
{

    public function run()
    {
        if (env('APP_DEBUG')) {
            $this->newDistributor();
        }
    }

    public function newDistributor()
    {
        DB::table('new_distributor')->insert([
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
            'fk_id_address'=>1,
            'fk_id_order'=>1
        ]);
    }

}

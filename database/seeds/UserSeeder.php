<?php

use \Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public $faker;

    public function run()
    {
        $this->faker = Faker\Factory::create();

        $this->users();

    }

    public function users()
    {
        $this->role();
        $this->corporateData();

        if (env('APP_DEBUG')) {
            $this->admin();
            $this->branch();
        }else{
            $this->adminP();
        }

    }

    public function corporateData(){

        DB::table('corporate_data')->insert([
            'name' => 'Corporativo',
            'phone' => '+5217223490089',
        ]);

    }

    public function admin()
    {
        DB::table('user')->insert([
            [
                'email' => 'admin@fenix.com.mx',
                'password' => bcrypt('prueba'),
                'name' => $this->faker->firstNameMale,
                'fk_id_role' => 1,
            ]
        ]);
    }

    public function branch()
    {

        $idAddress = DB::table('address')->insertGetId([
                'street' => 'W Market Sr',
                'zip_code' => 27401,
                'ext_num' => 239,
                'colony' => 'Downtown',
                'city' => 'Greensbore',
                'state' => 'North Caroline',
                'fk_id_country' => 2
            ]);

        $idBranch = DB::table('branch')->insertGetId([
                'name' => 'Greensbore',
                'fk_id_address' => $idAddress,
            ]);

        DB::table('user')->insert([
                'email' => 'greensboro@fenix.com.mx',
                'password' => bcrypt('prueba'),
                'name' => $this->faker->firstNameMale,
                'fk_id_role' => 2,
                'fk_id_branch' => $idBranch
            ]);

        $idAddress = DB::table('address')->insertGetId([
            'street' => 'Avenida 5',
            'zip_code' => 52140,
            'ext_num' => 20,
            'colony' => 'La Pila',
            'city' => 'Metepec',
            'state' => 'Estado de México',
            'fk_id_country' => 1
        ]);

        $idBranch = DB::table('branch')->insertGetId([
            'name' => 'Metepec',
            'fk_id_address' => $idAddress,
        ]);

        DB::table('user')->insert([
            'email' => 'metepec@fenix.com.mx',
            'password' => bcrypt('prueba'),
            'name' => $this->faker->firstNameMale,
            'fk_id_role' => 2,
            'fk_id_branch' => $idBranch
        ]);
    }

    public function adminP()
    {
        DB::table('user')->insert([
            [
                'email' => 'admin@fenix.com.mx',
                'password' => bcrypt('70nic1if3'),
                'name' => 'Alejandra',
                'fk_id_role' => 1,
            ]
        ]);
    }

    public function role(){
        DB::table('role')->insert([
            [
                'name' => 'Administrador'
            ],[
                'name' => 'Sucursal'
            ]
        ]);
    }
}


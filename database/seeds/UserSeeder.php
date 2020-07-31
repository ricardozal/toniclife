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
            'phone' => '+527221666002',
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
                'street' => $this->faker->streetName,
                'zip_code' => $this->faker->numberBetween(5000, 6000),
                'ext_num' => $this->faker->numberBetween(100, 500),
                'colony' => $this->faker->streetSuffix,
                'city' => $this->faker->city,
                'state' => $this->faker->state,
                'fk_id_country' => 1
            ]);

        $idBranch = DB::table('branch')->insertGetId([
                'name' => $this->faker->firstNameMale,
                'fk_id_address' => $idAddress,
            ]);

        DB::table('user')->insert([
                'email' => 'sucursal@fenix.com.mx',
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


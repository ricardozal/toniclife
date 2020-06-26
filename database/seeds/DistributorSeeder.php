<?php


use Illuminate\Support\Facades\DB;

class DistributorSeeder extends \Illuminate\Database\Seeder
{
    public $faker;

    public function run()
    {
        $this->faker = Faker\Factory::create();

        if (env('APP_DEBUG', false)) {
            $this->distributors();
        }

    }

    public function distributors()
    {

        for($i = 0; $i<2 ;$i++){

            DB::table('distributor')->insert([
                'name' => $this->faker->firstNameMale,
                'tonic_life_id' => 'DIST-'.$i,
                'email' => $this->faker->email,
                'password' => bcrypt('prueba'),
                'accumulated_points' => 0
            ]);

        }

        for($i = 2; $i<4 ;$i++){

            DB::table('distributor')->insert([
                'name' => $this->faker->firstNameMale,
                'tonic_life_id' => 'DIST-'.$i,
                'email' => $this->faker->email,
                'password' => bcrypt('prueba'),
                'accumulated_points' => 0,
                'fk_id_distributor' => 1
            ]);

        }

        for($i = 4; $i<6 ;$i++){

            DB::table('distributor')->insert([
                'name' => $this->faker->firstNameMale,
                'tonic_life_id' => 'DIST-'.$i,
                'email' => $this->faker->email,
                'password' => bcrypt('prueba'),
                'accumulated_points' => 0,
                'fk_id_distributor' => 2
            ]);

        }


    }

}

<?php


use Illuminate\Support\Facades\DB;

class DistributorSeeder extends \Illuminate\Database\Seeder
{
    public $faker;

    public function run()
    {
        $this->faker = Faker\Factory::create();

//        if (env('APP_DEBUG', false)) {
            $this->distributors();
//        }

    }

    public function distributors()
    {

        for($i = 0; $i<2 ;$i++){

            $id = DB::table('distributor')->insertGetId([
                'name' => $this->faker->firstNameMale,
                'tonic_life_id' => 'DIST-'.$i,
                'email' => $this->faker->email,
                'password' => bcrypt('prueba'),
            ]);

            DB::table('point_history')->insert([
                'accumulated_points' => 0,
                'begin_period' => Carbon\Carbon::now()->toDateString(),
                'end_period' => Carbon\Carbon::now()->addMonth()->toDateString(),
                'fk_id_distributor' => $id
            ]);

        }

        for($i = 2; $i<4 ;$i++){

            $id = DB::table('distributor')->insertGetId([
                'name' => $this->faker->firstNameMale,
                'tonic_life_id' => 'DIST-'.$i,
                'email' => $this->faker->email,
                'password' => bcrypt('prueba'),
                'fk_id_distributor' => 1
            ]);

            DB::table('point_history')->insert([
                'accumulated_points' => 0,
                'begin_period' => Carbon\Carbon::now()->toDateString(),
                'end_period' => Carbon\Carbon::now()->addMonth()->toDateString(),
                'fk_id_distributor' => $id
            ]);

        }

        for($i = 4; $i<6 ;$i++){

            $id = DB::table('distributor')->insertGetId([
                'name' => $this->faker->firstNameMale,
                'tonic_life_id' => 'DIST-'.$i,
                'email' => $this->faker->email,
                'password' => bcrypt('prueba'),
                'fk_id_distributor' => 2
            ]);

            DB::table('point_history')->insert([
                'accumulated_points' => 0,
                'begin_period' => Carbon\Carbon::now()->toDateString(),
                'end_period' => Carbon\Carbon::now()->addMonth()->toDateString(),
                'fk_id_distributor' => $id
            ]);

        }


    }

}

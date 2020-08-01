<?php


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DistributorSeeder extends \Illuminate\Database\Seeder
{
    public $faker;

    public function run()
    {
        $this->faker = Faker\Factory::create();

        if (env('APP_DEBUG')) {
            $this->distributors();
        }

    }

    public function distributors()
    {

        $today = Carbon::now();
        $day = $today->day;
        $month = $today->month;
        $year = $today->year;
        
        if($day < 26){
            $monthBefore = Carbon::now()->subMonth()->month;
            $beginDate = Carbon::create($year,$monthBefore,26);
            $endDate = Carbon::create($year,$monthBefore,25)->addMonth();
        } else {
            $beginDate = Carbon::create($year,$month,26);
            $endDate = Carbon::create($year,$month,25)->addMonth();
        }

        for($i = 0; $i<2 ;$i++){

            $id = DB::table('distributor')->insertGetId([
                'name' => $this->faker->firstNameMale,
                'tonic_life_id' => 'DIST-'.$i,
                'email' => $this->faker->email,
                'password' => bcrypt('prueba'),
            ]);

            DB::table('point_history')->insert([
                'accumulated_points' => 0,
                'begin_period' => $beginDate,
                'end_period' => $endDate,
                'fk_id_distributor' => $id
            ]);

            for($j = 0; $j<3;$j++)
            {
                $city = '';
                $state = '';
                if($i == 0){
                    switch ($j){
                        case 0:
                            $city = 'Monterrey';
                            $state = 'Nuevo León';
                            break;
                        case 1:
                            $city = 'Morelia';
                            $state = 'Michoacán';
                            break;
                        case 2:
                            $city = 'Irapuato';
                            $state = 'Guanajuato';
                            break;
                    }
                } else {
                    switch ($j){
                        case 0:
                            $city = 'Asheville';
                            $state = 'North Carolina';
                            break;
                        case 1:
                            $city = 'Charlotte';
                            $state = 'North Carolina';
                            break;
                        case 2:
                            $city = 'Greenville';
                            $state = 'South Carolina';
                            break;
                    }
                }

                $idAddress = DB::table('address')->insertGetId([
                    'street' => ($i == 0) ? 'Hidalgo' : 'Bo Glen',
                    'zip_code' => $this->faker->numberBetween(5000, 6000),
                    'ext_num' => $this->faker->numberBetween(100, 500),
                    'colony' => ($i == 0) ? 'Universidad' : 'Port',
                    'city' => $city,
                    'state' => $state,
                    'fk_id_country' => $i == 0 ? 1 : 2
                ]);

                DB::table('distributor_has_addresses')->insert([
                    'alias' => 'Dirección '.($j+1),
                    'selected' => $j == 0,
                    'fk_id_distributor' => $id,
                    'fk_id_address' => $idAddress
                ]);
            }

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
                'begin_period' => $beginDate,
                'end_period' => $endDate,
                'fk_id_distributor' => $id
            ]);

            for($j = 0; $j<3;$j++)
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

                DB::table('distributor_has_addresses')->insert([
                    'alias' => 'Dirección '.($j+1),
                    'selected' => $j == 0,
                    'fk_id_distributor' => $id,
                    'fk_id_address' => $idAddress
                ]);
            }

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
                'begin_period' => $beginDate,
                'end_period' => $endDate,
                'fk_id_distributor' => $id
            ]);

            for($j = 0; $j<3;$j++)
            {
                $idAddress = DB::table('address')->insertGetId([
                    'street' => $this->faker->streetName,
                    'zip_code' => $this->faker->numberBetween(5000, 6000),
                    'ext_num' => $this->faker->numberBetween(100, 500),
                    'colony' => $this->faker->streetSuffix,
                    'city' => $this->faker->city,
                    'state' => $this->faker->state,
                    'fk_id_country' => 2
                ]);

                DB::table('distributor_has_addresses')->insert([
                    'alias' => 'Dirección '.($j+1),
                    'selected' => $j == 0,
                    'fk_id_distributor' => $id,
                    'fk_id_address' => $idAddress
                ]);
            }

        }


    }

}

<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Country;
use \App\Models\TrafficLights;

class AccumulatedPoitsStatusSeeder extends Seeder
{

    public function run()
    {
        $this->trafficLights();
        $this->statuses();
    }

    public function trafficLights(){

        DB::table('traffic_lights')->insert([
            'name' => 'Blanco',
            'color' => '#ffffff'
        ]);

        DB::table('traffic_lights')->insert([
            'name' => 'Rojo',
            'color' => '#ff6f5e'
        ]);

        DB::table('traffic_lights')->insert([
            'name' => 'Amarillo',
            'color' => '#ffff00'
        ]);

        DB::table('traffic_lights')->insert([
            'name' => 'Verde',
            'color' => '#00cc33'
        ]);

        DB::table('traffic_lights')->insert([
            'name' => 'Azúl claro',
            'color' => '#66ffff'
        ]);

        DB::table('traffic_lights')->insert([
            'name' => 'Azúl oscuro',
            'color' => '#023891'
        ]);

    }

    public function statuses(){

        //WHITE
        DB::table('accumulated_points_status')->insert([
            'limit' => 0,
            'with_points' => true,
            'fk_id_country' => Country::MEX,
            'fk_id_traffic_lights' => TrafficLights::WHITE
        ]);

        DB::table('accumulated_points_status')->insert([
            'limit' => 0,
            'with_points' => false,
            'fk_id_country' => Country::USA,
            'fk_id_traffic_lights' =>  TrafficLights::WHITE
        ]);

        //RED
        DB::table('accumulated_points_status')->insert([
            'limit' => 2000,
            'with_points' => true,
            'fk_id_country' => Country::MEX,
            'fk_id_traffic_lights' => TrafficLights::RED
        ]);

        DB::table('accumulated_points_status')->insert([
            'limit' => 70,
            'with_points' => false,
            'fk_id_country' => Country::USA,
            'fk_id_traffic_lights' => TrafficLights::RED
        ]);

        //YELLOW
        DB::table('accumulated_points_status')->insert([
            'limit' => 2800,
            'with_points' => true,
            'fk_id_country' => Country::MEX,
            'fk_id_traffic_lights' => TrafficLights::YELLOW
        ]);

        DB::table('accumulated_points_status')->insert([
            'limit' => 100,
            'with_points' => false,
            'fk_id_country' => Country::USA,
            'fk_id_traffic_lights' => TrafficLights::YELLOW
        ]);

        //GREEN
        DB::table('accumulated_points_status')->insert([
            'limit' => 3300,
            'with_points' => true,
            'fk_id_country' => Country::MEX,
            'fk_id_traffic_lights' => TrafficLights::GREEN
        ]);

        DB::table('accumulated_points_status')->insert([
            'limit' => 150,
            'with_points' => false,
            'fk_id_country' => Country::USA,
            'fk_id_traffic_lights' => TrafficLights::GREEN
        ]);

        //LIGHT BLUE
        DB::table('accumulated_points_status')->insert([
            'limit' => 4000,
            'with_points' => true,
            'fk_id_country' => Country::MEX,
            'fk_id_traffic_lights' => TrafficLights::LIGHT_BLUE
        ]);

        DB::table('accumulated_points_status')->insert([
            'limit' => 300,
            'with_points' => false,
            'fk_id_country' => Country::USA,
            'fk_id_traffic_lights' => TrafficLights::LIGHT_BLUE
        ]);

        //STRONG BLUE
        DB::table('accumulated_points_status')->insert([
            'limit' => 6000,
            'with_points' => true,
            'fk_id_country' => Country::MEX,
            'fk_id_traffic_lights' => TrafficLights::STRONG_BLUE
        ]);

        DB::table('accumulated_points_status')->insert([
            'limit' => 450,
            'with_points' => false,
            'fk_id_country' => Country::USA,
            'fk_id_traffic_lights' => TrafficLights::STRONG_BLUE
        ]);

    }

}

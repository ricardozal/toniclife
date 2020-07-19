<?php


use Illuminate\Support\Facades\DB;

class PromotionSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        if (env('APP_DEBUG')) {
            $this->promotions();
        }
    }

    public function promotions()
    {
        DB::table('promotion')->insert([
            'name' => 'Evita el sedentarismo',
            'description' => 'Califica con 4,000 pts y llévate un Tonic Clean 500ml',
            'min_amount' => 4000,
            'begin_date' => '2020-06-26',
            'expiration_date' => '2020-07-15',
            'fk_id_country' => 1,
            'with_points' => 1,
            'is_accumulative' => 1
        ]);
    }

}

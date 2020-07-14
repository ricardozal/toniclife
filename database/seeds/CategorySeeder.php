<?php


use Illuminate\Support\Facades\DB;

class CategorySeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        if (env('APP_DEBUG')) {
            DB::table('category')->insert([
                'name'=> 'Sistema respiratorio'
            ]);
        }
    }
}

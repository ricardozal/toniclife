<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductsMexSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(DistributorSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(OrderSeeder::class);
    }

}

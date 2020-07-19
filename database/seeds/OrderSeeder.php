<?php
use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{

    public $faker;

    public function run()
    {
        $this->faker = Faker\Factory::create();
        if (env('APP_DEBUG')) {
            $this->order();
        }
    }

    public function order()
    {
        /* ORDER 1 */
        $product1 = \App\Models\Product::whereId(1)->first();
        $product2 = \App\Models\Product::whereId(2)->first();
        $product3 = \App\Models\Product::whereId(3)->first();
        $distributor = \App\Models\Distributor::whereId(1)->first();

        $totalPrice = ((($product1->distributor_price*2)+(($product1->country->tax_percentage*0.01)*($product1->distributor_price*2)))+
            (($product2->distributor_price*2)+(($product2->country->tax_percentage*0.01)*($product2->distributor_price*2)))+
            (($product3->distributor_price*2)+(($product3->country->tax_percentage*0.01)*($product3->distributor_price*2))));

        $totalTaxes =   (((($product1->country->tax_percentage*0.01)*($product1->distributor_price*2)))+
            ((($product2->country->tax_percentage*0.01)*($product2->distributor_price*2)))+
            ((($product3->country->tax_percentage*0.01)*($product3->distributor_price*2))));

        $points = ($product1->points*2)+($product2->points*2)+($product3->points*2);

        $orderId = DB::table('order')->insertGetId([
            'total_price'=>$totalPrice,
            'total_taxes'=>$totalTaxes,
            'total_accumulated_points'=>$points,
            'shipping_price'=>50,
            'fk_id_distributor'=>$distributor->id,
            'fk_id_order_status' => 1,
            'fk_id_branch' => 1,
            'fk_id_payment_method' => 1,
            'created_at'=>Carbon\Carbon::now()->toDateString()
        ]);

        $today = \Carbon\Carbon::now();

        foreach ($distributor->accumulatedPointsHistory as $point)
        {
            $begin = \Carbon\Carbon::parse($point->begin_period);
            $end = \Carbon\Carbon::parse($point->end_period);
            if ($today->between($begin,$end))
            {
                $point->accumulated_points = $point->accumulated_points+$points;
                $point->save();
            } else{
                $point = new \App\Models\PointsHistory();
                $point->begin_period = $today;
                $point->end_period = $today->addMonth();
                $point->accumulated_points = $points;
                $point->fk_id_distributor = $distributor->id;
                $point->save();
            }
        }

        DB::table('order_product')->insert([
            'price' => (($product1->distributor_price*2)+(($product1->country->tax_percentage*0.01)*($product1->distributor_price*2))),
            'quantity' => 2,
            'fk_id_product' => $product1->id,
            'fk_id_order' => $orderId
        ]);

        DB::table('order_product')->insert([
            'price' => (($product2->distributor_price*2)+(($product2->country->tax_percentage*0.01)*($product2->distributor_price*2))),
            'quantity' => 2,
            'fk_id_product' => $product2->id,
            'fk_id_order' => $orderId
        ]);

        DB::table('order_product')->insert([
            'price' => (($product3->distributor_price*2)+(($product3->country->tax_percentage*0.01)*($product3->distributor_price*2))),
            'quantity' => 2,
            'fk_id_product' => $product3->id,
            'fk_id_order' => $orderId
        ]);



        /* ORDER 2 */
        $product4 = \App\Models\Product::whereId(102)->first();

        $totalKitPrice = ((($product4->distributor_price)+(($product4->country->tax_percentage*0.01)*($product4->distributor_price))));
        $totalKitTaxes = (((($product4->country->tax_percentage*0.01)*($product4->distributor_price))));
        $pointsKit = ($product4->points);

        $idAddress = DB::table('address')->insertGetId([
            'street' => $this->faker->streetName,
            'zip_code' => $this->faker->numberBetween(5000, 6000),
            'ext_num' => $this->faker->numberBetween(100, 500),
            'colony' => $this->faker->streetSuffix,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'fk_id_country' => 1
        ]);

        $orderKitId = DB::table('order')->insertGetId([
            'total_price'=>$totalKitPrice,
            'total_taxes'=>$totalKitTaxes,
            'total_accumulated_points'=>$pointsKit,
            'shipping_price'=>50,
            'fk_id_distributor'=>$distributor->id,
            'fk_id_order_status' => 1,
            'fk_id_shipping_address' => $idAddress,
            'fk_id_branch' => 1,
            'fk_id_payment_method' => 1,
            'created_at'=>Carbon\Carbon::now()->toDateString()
        ]);

        $today = \Carbon\Carbon::now()->addDay();

        foreach ($distributor->accumulatedPointsHistory as $point)
        {
            $begin = \Carbon\Carbon::parse($point->begin_period);
            $end = \Carbon\Carbon::parse($point->end_period);
            if ($today->between($begin,$end))
            {
                $point->accumulated_points = $point->accumulated_points+$pointsKit;
                $point->save();
            } else{
                $point = new \App\Models\PointsHistory();
                $point->begin_period = $today;
                $point->end_period = $today->addMonth();
                $point->accumulated_points = $pointsKit;
                $point->fk_id_distributor = $distributor->id;
                $point->save();
            }
        }


        DB::table('order_product')->insert([
            'price' => (($product4->distributor_price)+(($product4->country->tax_percentage*0.01)*($product4->distributor_price))),
            'quantity' => 1,
            'fk_id_product' => $product4->id,
            'fk_id_order' => $orderKitId
        ]);
    }

}

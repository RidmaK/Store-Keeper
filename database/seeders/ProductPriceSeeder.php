<?php

namespace Database\Seeders;

use App\Models\ProductPrice;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $price = [
            [ 'price_id' =>1,'pro_id' =>1,'price_code' => "p0001", 'price' =>300, 'date_to' =>'2022-04-30', 'date_from' =>Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'price_id' =>2,'pro_id' =>2,'price_code' => "p0002", 'price' =>400, 'date_to' =>'2022-04-30', 'date_from' =>Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'price_id' =>3,'pro_id' =>3,'price_code' => "p0003", 'price' =>350, 'date_to' =>'2022-04-30', 'date_from' =>Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'price_id' =>4,'pro_id' =>4,'price_code' => "p0004", 'price' =>360, 'date_to' =>'2022-04-30', 'date_from' =>Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'price_id' =>5,'pro_id' =>5,'price_code' => "p0005", 'price' =>370, 'date_to' =>'2022-04-30', 'date_from' =>Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'price_id' =>6,'pro_id' =>6,'price_code' => "p0006", 'price' =>3800, 'date_to' =>'2022-04-30', 'date_from' =>Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'price_id' =>7,'pro_id' =>7,'price_code' => "p0007", 'price' =>3090, 'date_to' =>'2022-04-30', 'date_from' =>Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];

        ProductPrice::insert($price);
    }
}

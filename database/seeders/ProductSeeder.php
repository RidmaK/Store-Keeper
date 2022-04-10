<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [ 'pro_id' =>1,'pro_name' => "Travel Bag", 'pro_code' =>"Bag1233", 'pro_short_name' =>"Travel Bag", 'url' =>"images/6.jpg", 'pro_description' =>"A small bag, as a valise or suitcase, usually made of leather, having an oblong shape, and used chiefly to hold clothes.", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_id' =>2,'pro_name' => "Hand Bag", 'pro_code' =>"Bag1234", 'pro_short_name' =>"Hand Bag", 'url' =>"images/7.jpg", 'pro_description' =>"A small bag, as a valise or suitcase, usually made of leather, having an oblong shape, and used chiefly to hold clothes.", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_id' =>3,'pro_name' => "Analog Wrist Watch", 'pro_code' =>"watch1234", 'pro_short_name' =>"Analog Wrist Watch", 'url' =>"images/3.jpg", 'pro_description' =>"A wristwatch is designed to be worn around the wrist, attached by a watch strap or other type of bracelet, including metal bands, leather straps or any other kind of bracelet. A pocket watch is designed for a person to carry in a pocket, often attached to a chain..", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_id' =>4,'pro_name' => "Digital Wrist Watch", 'pro_code' =>"watch1235", 'pro_short_name' =>"Digital Wrist Watch", 'url' =>"images/2.jpg", 'pro_description' =>"A wristwatch is designed to be worn around the wrist, attached by a watch strap or other type of bracelet, including metal bands, leather straps or any other kind of bracelet. A pocket watch is designed for a person to carry in a pocket, often attached to a chain..", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_id' =>5,'pro_name' => "Casio Wrist Watch", 'pro_code' =>"watch1264", 'pro_short_name' =>"Casio Wrist Watch", 'url' =>"images/1.jpg", 'pro_description' =>"A wristwatch is designed to be worn around the wrist, attached by a watch strap or other type of bracelet, including metal bands, leather straps or any other kind of bracelet. A pocket watch is designed for a person to carry in a pocket, often attached to a chain..", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_id' =>6,'pro_name' => "Men SunGlasses", 'pro_code' =>"sun1264", 'pro_short_name' =>"Men SunGlasses", 'url' =>"images/4.jpg", 'pro_description' =>"Sunglasses or sun glasses are a form of protective eyewear designed primarily to prevent bright sunlight and high-energy visible light from damaging", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_id' =>6,'pro_name' => "Women SunGlasses", 'pro_code' =>"sun1234", 'pro_short_name' =>"Women SunGlasses", 'url' =>"images/5.jpg", 'pro_description' =>"Sunglasses or sun glasses are a form of protective eyewear designed primarily to prevent bright sunlight and high-energy visible light from damaging", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        Product::insert($product);
    }
}

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
            [ 'pro_id' =>1,'pro_name' => "Travel Bag", 'pro_code' =>"Bag1233", 'pro_short_name' =>"Travel Bag", 'pro_description' =>"A small bag, as a valise or suitcase, usually made of leather, having an oblong shape, and used chiefly to hold clothes.", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        Product::insert($product);
    }
}

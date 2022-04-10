<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_categories = [
            [ 'pro_sc_id' => 1, 'pro_sc_name' => 'Sun Glass', 'pro_sc_code' => 'S0001', 'pro_sc_short_name' => 'Sun Glass', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 2, 'pro_sc_name' => 'Watch', 'pro_sc_code' => 'S0002', 'pro_sc_short_name' => 'Watch', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 3, 'pro_sc_name' => 'Bag', 'pro_sc_code' => 'S0003', 'pro_sc_short_name' => 'Bag', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 4, 'pro_sc_name' => 'Blazers', 'pro_sc_code' => 'S0004', 'pro_sc_short_name' => 'Blazers', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 5, 'pro_sc_name' => 'T Shirt', 'pro_sc_code' => 'S0005', 'pro_sc_short_name' => 'T Shirt', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 6, 'pro_sc_name' => 'Short', 'pro_sc_code' => 'S0006', 'pro_sc_short_name' => 'Short', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 7, 'pro_sc_name' => 'Shoes', 'pro_sc_code' => 'S0007', 'pro_sc_short_name' => 'Shoes', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 8, 'pro_sc_name' => 'Belt', 'pro_sc_code' => 'S0008', 'pro_sc_short_name' => 'Belt', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 9, 'pro_sc_name' => 'Frock', 'pro_sc_code' => 'S0009', 'pro_sc_short_name' => 'Frock', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 10, 'pro_sc_name' => 'Neckless', 'pro_sc_code' => 'S00010', 'pro_sc_short_name' => 'Neckless', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_sc_id' => 11, 'pro_sc_name' => 'Ring', 'pro_sc_code' => 'S00011', 'pro_sc_short_name' => 'Ring', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
         ];

        SubCategory::insert($sub_categories);
    }
}

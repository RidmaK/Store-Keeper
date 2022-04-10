<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'pro_mc_id' => 1, 'pro_mc_name' => 'men', 'pro_mc_code' => 'm0001', 'pro_mc_short_name' => 'men', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_mc_id' => 2, 'pro_mc_name' => 'Women', 'pro_mc_code' => 'w0001', 'pro_mc_short_name' => 'Women', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_mc_id' => 3, 'pro_mc_name' => 'Kids', 'pro_mc_code' => 'K0001', 'pro_mc_short_name' => 'Kids', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'pro_mc_id' => 4, 'pro_mc_name' => 'Unisex', 'pro_mc_code' => 'U0001', 'pro_mc_short_name' => 'Unisex', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
         ];

        Category::insert($categories);
    }
}

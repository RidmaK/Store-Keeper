<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'id' =>1,'pro_id' =>1,'pro_mc_id' => 1, 'pro_sc_id' =>3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        CategoryProduct::insert($categories);
    }
}

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
            [ 'id' =>2,'pro_id' =>2,'pro_mc_id' => 2, 'pro_sc_id' =>3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>3,'pro_id' =>3,'pro_mc_id' => 1, 'pro_sc_id' =>2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>4,'pro_id' =>4,'pro_mc_id' => 1, 'pro_sc_id' =>2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>5,'pro_id' =>5,'pro_mc_id' => 1, 'pro_sc_id' =>2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>6,'pro_id' =>6,'pro_mc_id' => 1, 'pro_sc_id' =>1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>7,'pro_id' =>7,'pro_mc_id' => 2, 'pro_sc_id' =>1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        CategoryProduct::insert($categories);
    }
}

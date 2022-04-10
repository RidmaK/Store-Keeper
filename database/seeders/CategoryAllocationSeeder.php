<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryAllocation;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'id' =>1,'pro_mc_id' => 1, 'pro_sc_id' =>1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>2 ,'pro_mc_id' => 1, 'pro_sc_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>3 ,'pro_mc_id' => 2, 'pro_sc_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>4 ,'pro_mc_id' => 2, 'pro_sc_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>5 ,'pro_mc_id' => 1, 'pro_sc_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' =>6 ,'pro_mc_id' => 2, 'pro_sc_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
         ];

        CategoryAllocation::insert($categories);
    }
}

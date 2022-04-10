<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [ 'id' => 1, 'title' => 'category_add' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 2, 'title' => 'category_show' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 3, 'title' => 'category_update' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 4, 'title' => 'category_destroy' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 5, 'title' => 'sub_category_add' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 6, 'title' => 'sub_category_show' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 7, 'title' => 'sub_category_update' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 8, 'title' => 'sub_category_destroy' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 9, 'title' => 'product_add' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 10, 'title' => 'product_show' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 11, 'title' => 'product_update' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 12, 'title' => 'product_destroy' , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        Permission::insert($permissions);
    }
}

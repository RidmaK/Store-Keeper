<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ 'id' => 1, 'title' => 'admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            [ 'id' => 2, 'title' => 'guest', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        Role::insert($roles);
    }
}

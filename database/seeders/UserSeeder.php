<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => 1, 'name' => 'admin', 'email' => 'admin@sales.com', 'password' => bcrypt('admin@123'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Guest User', 'email' => 'guest@sales.com', 'password' => bcrypt('guest@123'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        User::insert($users);
    }
}

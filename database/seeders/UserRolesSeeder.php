<?php

namespace Database\Seeders;

use App\BO\Department\v100\Models\MainGroup;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema:: disableForeignKeyConstraints();

        // DB:: table('payment_methods')->truncate();

        Role::truncate();

        Schema:: enableForeignKeyConstraints();

        $user_roles = [
            0 => [
                'name' => 'super_admin',
                'guard_name'=>'web',
                'display_name' => 'Admin',
                'created_at' => Carbon::now(),
            ],

        ];
        $i = 1;
        foreach ($user_roles as $key => $user_roles) {
            Role::firstOrCreate([
                 'id' => $i,
                 'name' => $user_roles['name'],
                 'guard_name' => $user_roles['guard_name'],
                 'display_name' => $user_roles['display_name'],
                 'created_at' => $user_roles['created_at'],
             ]);
            $i++;
        }
    }
}

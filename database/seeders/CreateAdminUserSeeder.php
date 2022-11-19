<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = \App\Models\Role::updateOrCreate(['name' => 'super_admin'], [
            'name' => 'super_admin',
            'guard_name' => 'web',
            'display_name' => 'Admin',
        ]);
        $user = \App\Models\User::updateOrCreate(['email' => 'admin@layoutindex.com'], [
            'name' => 'Admin',
            'email' => 'admin@layoutindex.com',
            'password' => bcrypt('123456789'),
            'is_super_admin' => 1,
            'type' => 'admin',
        ]);
        $user = \App\Models\User::first();
        $roleAdmin = \App\Models\Role::first();

        $permissions = \App\Models\Permission::pluck('id', 'id')->all();

        $roleAdmin->syncPermissions($permissions);

        $user->assignRole([$roleAdmin->id]);

        $roleLecturer = \App\Models\Role::updateOrCreate(['name' => 'lecturer'], [
            'name' => 'lecturer',
            'guard_name' => 'web',
            'display_name' => 'Lecturer',
        ]);
    }
}

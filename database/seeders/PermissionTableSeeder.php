<?php

namespace Database\Seeders;

// use Spatie\Permission\Models\Permission;

use App\Models\MainGroup;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionTableSeeder extends Seeder
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

        Permission::truncate();
        MainGroup::truncate();

        Schema:: enableForeignKeyConstraints();


        $main_groups = getAcl();
        foreach ($main_groups as $key => $main_group) {
            if ($main_group['status'] == 0) {
                continue;
            }

            $mainGroupData = MainGroup::create([
                //'id' => $main_group['id'],
                'name' => $main_group['name'],
                'order' => $main_group['order'],
                'status' => $main_group['status'],
            ]);

            if (count($main_group['permissions']) > 0) {
                $permissionsMain = $main_group['permissions'];
                //dd($permissionsMain);

                foreach ($permissionsMain as $keyMain => $permissions) {
                    if ($permissions['status'] == 0) {
                        continue;
                    }

                    $permissions = $permissions['permissions_list'];

                    foreach ($permissions as $key => $permission) {
                        try {
                            $da = Permission::updateOrCreate(['name' => $permission['name']], [
                                //'id' => $permission['id'],
                                'name' => $permission['name'],
                                'permission_label' => $permission['permission_label'],
                                'group' => $keyMain,
                                'guard_name' => $permission['guard_name'],
                                'main_group' => $mainGroupData->id,
                                'sub_group' => $permission['sub_group'],
                                'sub_order' => $permission['sub_order'],
                            ]);
                        } catch (\Exception $e) {
                            dd($e, [
                                //'id' => $permission['id'],
                                'name' => $permission['name'] ?? 'xx',
                                'permission_label' => $permission['permission_label'],
                                'group' => $keyMain,
                                'guard_name' => $permission['guard_name'],
                                'main_group' => $mainGroupData->id,
                                'sub_group' => $permission['sub_group'],
                                'sub_order' => $permission['sub_order'],
                            ]);
                        }
                    }
                }
            }
        }
    }
}

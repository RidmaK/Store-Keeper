<?php

namespace App\Http\Controllers;

use App\Models\Permission;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $roles = Role::get();
        return view('contents.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();

        $permission = $permission->groupBy('main_group')->map(function ($catGame) {
            return $catGame->groupBy('sub_group')->map(function ($catGame2) {
                return $catGame2->groupBy('group');
            });
        });

        $formattedPermission = [];

        foreach ($permission as $key => $subGroups) {
            $formattedPermission[$key]['main_group'] = $subGroups->first()->first()->first()->mainGroup->name ?? '';

            foreach ($subGroups as $keyEle => $subElement) {
                foreach ($subElement as $key3 => $subGroup) {
                    $fullName = $subGroup->first()->permission_label;
                    $perm_arr = explode(' ', $fullName);
                    $label = '';
                    foreach ($perm_arr as $key2 => $perm) {
                        if ($key2 < count($perm_arr) - 1) {
                            $label .= ' '.$perm;
                        }
                    }
                    $subPermissions = [];
                    $parent = false;
                    foreach ($subGroup as $key4 => $eachPermission) {
                        $fullNamePermission = $eachPermission->name;
                        $perm_arr2 = explode('-', $fullNamePermission);
                        $permissionName = end($perm_arr2);
                        $subPermissions[$key4]['key'] = $permissionName;
                        $subPermissions[$key4]['id'] = $eachPermission->id;
                        if ($eachPermission->parent !== null) {
                            $parent = true;
                        }
                    }

                    $formattedPermission[$key]['sub_elements'][$keyEle]['title'] = isset($subGroup->first()->subGroup->name) ? $subGroup->first()->subGroup->name : '';
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['subGroupName'] = $label;
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['HasParent'] = $parent;
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['subGroupPermissions'] = $subPermissions;
                }
            }
        }

        return view('contents.roles.create', compact('permission', 'formattedPermission'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request['name'] = str_replace(' ', '_', strtolower($request->display_name));

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required|unique:roles,display_name',
            'permission' => 'required',
        ], [
            'display_name.required' => 'The name field is required',
            'display_name.unique' => 'The name has already been taken.',
        ]);

        $role = Role::create(['name' => $request['name'], 'display_name' => $request['display_name']]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')
            ->with('success', 'User Group has been created successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $id = decrypt($id);

        $role = Role::find($id);
        $permission = Permission::get();

//        $permission = $permission->groupBy('main_group')->map(function ($catGame) {
//            return $catGame->groupBy('group');
//        });

//        dd($permission);

        $permission = $permission->groupBy('main_group')->map(function ($catGame) {
            return $catGame->groupBy('sub_group')->map(function ($catGame2) {
                return $catGame2->groupBy('group');
            });
        });

        $formattedPermission = [];

        foreach ($permission as $key => $subGroups) {
            //  dd($subGroups->first()->first());
            $formattedPermission[$key]['main_group'] = $subGroups->first()->first()->first()->mainGroup->name ?? '';

            foreach ($subGroups as $keyEle => $subElement) {
                foreach ($subElement as $key3 => $subGroup) {
                    $fullName = $subGroup->first()->permission_label;
                    $perm_arr = explode(' ', $fullName);
                    $label = '';
                    foreach ($perm_arr as $key2 => $perm) {
                        if ($key2 < count($perm_arr) - 1) {
                            $label .= ' '.$perm;
                        }
                    }
                    $subPermissions = [];
                    $parent = false;
                    foreach ($subGroup as $key4 => $eachPermission) {
                        $fullNamePermission = $eachPermission->name;
                        $perm_arr2 = explode('-', $fullNamePermission);
                        $permissionName = end($perm_arr2);
                        $subPermissions[$key4]['key'] = $permissionName;
                        $subPermissions[$key4]['id'] = $eachPermission->id;
                        if ($eachPermission->parent !== null) {
                            $parent = true;
                        }
                    }
//                    dd($subGroup);
                    $formattedPermission[$key]['sub_elements'][$keyEle]['title'] = isset($subGroup->first()->subGroup->name) ? $subGroup->first()->subGroup->name : '';
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['subGroupName'] = $label;
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['HasParent'] = $parent;
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['subGroupPermissions'] = $subPermissions;
                }
            }
        }

//        dd($formattedPermission);

        $rolePermissions = RoleHasPermission::where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

//        $rolePermissions = Permission::leftJoin("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
//           ->where("role_has_permissions.role_id",$id)
//           ->get()->groupBy('group');

        //  $rolePermissions = Permission::get()->groupBy('group');

        return view('contents.roles.show', compact('role', 'rolePermissions', 'formattedPermission'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $role = Role::find($id);
        $permission = Permission::get();

//        $permission = $permission->groupBy('main_group')->map(function ($catGame) {
//            return $catGame->groupBy('group');
//        });

//        dd($permission);

        $permission = $permission->groupBy('main_group')->map(function ($catGame) {
            return $catGame->groupBy('sub_group')->map(function ($catGame2) {
                return $catGame2->groupBy('group');
            });
        });

        $formattedPermission = [];

        foreach ($permission as $key => $subGroups) {
//            dd($subGroups->first()->first()->mainGroup);
            $formattedPermission[$key]['main_group'] = $subGroups->first()->first()->first()->mainGroup->name ?? '';

            foreach ($subGroups as $keyEle => $subElement) {
                foreach ($subElement as $key3 => $subGroup) {
                    $fullName = $subGroup->first()->permission_label;
                    $perm_arr = explode(' ', $fullName);
                    $label = '';
                    foreach ($perm_arr as $key2 => $perm) {
                        if ($key2 < count($perm_arr) - 1) {
                            $label .= ' '.$perm;
                        }
                    }
                    $subPermissions = [];
                    $parent = false;
                    foreach ($subGroup as $key4 => $eachPermission) {
                        $fullNamePermission = $eachPermission->name;
                        $perm_arr2 = explode('-', $fullNamePermission);
                        $permissionName = end($perm_arr2);
                        $subPermissions[$key4]['key'] = $permissionName;
                        $subPermissions[$key4]['id'] = $eachPermission->id;
                        if ($eachPermission->parent !== null) {
                            $parent = true;
                        }
                    }
//                    dd($subGroup);
                    $formattedPermission[$key]['sub_elements'][$keyEle]['title'] = isset($subGroup->first()->subGroup->name) ? $subGroup->first()->subGroup->name : '';
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['subGroupName'] = $label;
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['HasParent'] = $parent;
                    $formattedPermission[$key]['sub_elements'][$keyEle]['subGroups'][$key3]['subGroupPermissions'] = $subPermissions;
                }
            }
        }

        $rolePermissions = RoleHasPermission::where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('contents.roles.edit', compact('role', 'permission', 'rolePermissions', 'formattedPermission'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'display_name' => 'required|unique:roles,display_name,'.$id,
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->display_name = $request->display_name;
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')
            ->with('success', 'User Group has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        DB::table('roles')->where('id', $id)->delete();

        return redirect()->route('role.index')
            ->with('success', 'Department has been deleted successfully');
    }
}

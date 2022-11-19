<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserGroupPermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $data = null)
    {
//        Get Modules from middleware string
        $modules = is_array($data)
            ? $data
            : explode('|', $data);

//        Get permissions after divided in to modules
        $permissions_array_with_modules =[];
        foreach($modules as $key=>$module){
            $permission = is_array($module)
                ? $data
                : explode(';', $module);
            $count = 0;
            $module_final = "";
            foreach ($permission as $per){
                $module_final = $permission[0];
                if (!($count == 0)){
                    $permissions_array_with_modules[$permission[0]][] = $per;
                }
                $count++;
            }

        }
//        check user group has module and permisssions
        if (Auth::user()->hasAnyRole(['super_admin'])){

        }
        if (!(Auth::user()->checkModuleandPermission($module_final,$per)) && !(Auth::user()->hasAnyRole(['super_admin']))) {
            abort(401);
        }


        return $next($request);

    }
}

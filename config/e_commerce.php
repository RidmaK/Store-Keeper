<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | User type (Roles)
    |--------------------------------------------------------------------------
    |
    */

    'role_admin' => env('APP_ROLE_ADMIN', 1),
    'role_guest' => env('APP_ROLE_GUEST', 2),

];

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class RoleHasPermission extends Model
{
    use  HasRoles;

    protected $table = 'role_has_permissions';
}

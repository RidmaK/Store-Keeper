<?php

namespace App\Models;

use App\BO\Department\v100\Models\Department;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $guard_name = [];

    public function department()
    {
        return $this->belongsToMany(Department::class, 'department_roles');
    }
}

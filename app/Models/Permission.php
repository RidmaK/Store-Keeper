<?php

namespace App\Models;

use App\Models\MainGroup as ModelsMainGroup;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public function mainGroup()
    {
        return $this->belongsTo(ModelsMainGroup::class, 'main_group');
    }

    public function subGroup()
    {
        return $this->belongsTo(MainGroup::class, 'sub_group');
    }
}

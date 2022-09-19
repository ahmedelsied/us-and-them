<?php

namespace HsmFawaz\UI\Services\RolesAndPermissions\Roles;

use HsmFawaz\UI\Services\RolesAndPermissions\RolesEnum;
use Spatie\Permission\Models\Role;

class UserRole
{
    public function execute()
    {
        $role = Role::updateOrCreate(['name' => RolesEnum::user()->value, 'guard_name' => 'web']);
    }
}

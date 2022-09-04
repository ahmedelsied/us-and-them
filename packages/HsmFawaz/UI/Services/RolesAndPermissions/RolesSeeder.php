<?php

namespace HsmFawaz\UI\Services\RolesAndPermissions;

use App\Domain\Core\Enums\CorePermissions;
use App\Domain\Assessment\Enums\AssessmentPermissions;
use HsmFawaz\UI\Services\RolesAndPermissions\Concerns\HasPermissionMap;
use HsmFawaz\UI\Services\RolesAndPermissions\Roles\ManagerRole;
use HsmFawaz\UI\Services\RolesAndPermissions\Roles\SuperAdminRole;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    use HasPermissionMap;

    protected array $roles = [
        SuperAdminRole::class,
        ManagerRole::class,
    ];

    protected array $permissions = [
        CorePermissions::class,
        AssessmentPermissions::class
    ];

    public function run()
    {
        $this->createPermissions();
        $this->seedRoles();
    }

    private function seedRoles()
    {
        foreach ($this->roles as $role) {
            (new $role())->execute();
        }
    }
}

<?php

use App\Domain\Core\Enums\CorePermissions;
use HsmFawaz\UI\Support\Sidebar\SidebarGenerator;

return static function (SidebarGenerator $sidebar) {
    $sidebar
        ->addModule('Administration', 10)
        ->addLink(
            name: __('Users'),
            url: route('dashboard.core.administration.users.index'),
            icon: 'fas fa-users',
            permission: CorePermissions::users()->can('read')
        )
        ->addLink(
            name: __('Roles and Permissions'),
            url: route('dashboard.core.administration.roles.index'),
            icon: 'fas fa-key',
            permission: CorePermissions::roles()->can('read')
        )
        ->addMenu(
            name: __('Settings'),
            icon: 'fas fa-cog',
            permission: CorePermissions::settings()->can('read'),
            links: function ($menu) {
            }
        );
};

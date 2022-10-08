<?php

use App\Domain\Core\Enums\ContactPermissions;
use HsmFawaz\UI\Support\Sidebar\SidebarGenerator;

return static function (SidebarGenerator $sidebar) {
    $sidebar
        ->addModule('Contact', 10)
        ->addLink(
            name: __('Careers'),
            url: route('dashboard.contact.careers.index'),
            icon: 'fa fa-suitcase',
            permission: ContactPermissions::career()->can('read')
        )
        ->addLink(
            name: __('Contact Messages'),
            url: route('dashboard.contact.contact-messages.index'),
            icon: 'fa fa-envelope',
            permission: ContactPermissions::contact()->can('read')
        );
};

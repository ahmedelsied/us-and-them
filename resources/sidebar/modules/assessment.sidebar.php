<?php

use App\Domain\Assessment\Enums\AssessmentPermissions;
use App\Domain\Assessment\Models\Field;
use HsmFawaz\UI\Support\Sidebar\SidebarGenerator;

return static function (SidebarGenerator $sidebar) {
    $sidebar
        ->addModule('Assessment')
        ->addMenu(
            name: __('Portage'),
            icon: 'fa fa-file-contract',
            permission: AssessmentPermissions::activities()->can('read'),
            links: function ($menu) {
                // $allFields = Field::all();
                // $menu->addLink(
                //     name: __('All Fields'),
                //     url: route('dashboard.assessment.fields.index'),
                //     icon: 'fa fa-layer-group',
                //     permission: AssessmentPermissions::fields()->can('read')
                // );
                // foreach($allFields as $field){
                //     $menu->addLink(
                //         name: $field->name,
                //         url: route('dashboard.assessment.fields.show',$field->id),
                //         icon: 'fa fa-layer-group',
                //         permission: AssessmentPermissions::fields()->can('read')
                //     );
                // }
                $menu->addLink(
                    name: __('Activities'),
                    url: route('dashboard.assessment.activities.index'),
                    icon: 'fa fa-layer-group',
                    permission: AssessmentPermissions::activities()->can('read')
                );
            }
        );
};

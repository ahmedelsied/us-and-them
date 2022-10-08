<?php

namespace App\Http\Controllers\Dashboard\Contact;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithDatatable;
use App\Support\Dashboard\Crud\WithDestroy;
use App\Domain\Contact\Datatables\CareerDatatable;
use App\Domain\Contact\Models\Career;
use App\Domain\Core\Enums\ContactPermissions;

class CareerController extends DashboardController
{
    use WithDatatable, WithDestroy;

    protected string $name = 'Career';
    protected string $path = 'dashboard.contact.careers';
    protected string $datatable = CareerDatatable::class;
    protected string $model = Career::class;
    protected array $permissions = [ContactPermissions::class, 'career'];

}

<?php

namespace App\Http\Controllers\Dashboard\Contact;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithDatatable;
use App\Support\Dashboard\Crud\WithDestroy;
use App\Domain\Contact\Datatables\ContactMessageDatatable;
use App\Domain\Contact\Models\ContactMessage;
use App\Domain\Core\Enums\ContactPermissions;

class ContactMessageController extends DashboardController
{
    use WithDatatable, WithDestroy;

    protected string $name = 'ContactMessage';
    protected string $path = 'dashboard.contact.contact-messages';
    protected string $datatable = ContactMessageDatatable::class;
    protected string $model = ContactMessage::class;
    protected array $permissions = [ContactPermissions::class, 'contact'];
}

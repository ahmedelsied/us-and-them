<?php

namespace App\Domain\Contact\Datatables;

use App\Domain\Contact\Models\ContactMessage;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;

class ContactMessageDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return ContactMessage::query();
    }

    protected function columns(): array
    {
        return [
            $this->column('name',__('Name')),
            $this->column('email',__('email')),
            $this->column('subject',__('Subject')),
            $this->column('message',__('Message')),
        ];
    }
}

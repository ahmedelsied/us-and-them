<?php

namespace App\Domain\Contact\Datatables;

use App\Domain\Contact\Models\ContactMessage;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;

class ContactMessageDatatable extends BaseDatatable
{
    protected ?string $actionable = 'delete';

    public function query(): Builder
    {
        return ContactMessage::latest();
    }

    protected function columns(): array
    {
        return [
            $this->column('id',__('ID')),
            $this->column('name',__('Name')),
            $this->column('email',__('email')),
            $this->column('subject',__('Subject')),
            $this->column('message',__('Message')),
            $this->column('created_at',__('Received At')),
        ];
    }
    
    protected function customColumns(): array
    {
        return [
            'created_at'    =>  fn($model) => $model->created_at->format('Y-m-d h:ia')
        ];
    }
}

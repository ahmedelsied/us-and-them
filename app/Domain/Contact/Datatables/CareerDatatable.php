<?php

namespace App\Domain\Contact\Datatables;

use App\Domain\Contact\Models\Career;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CareerDatatable extends BaseDatatable
{
    protected ?string $actionable = 'delete';
    public function query(): Builder
    {
        return Career::with('media')->latest();
    }

    protected function columns(): array
    {
        return [
            $this->column('name',__('Name')),
            $this->column('email',__('Email')),
            $this->column('resume',__('Resume')),
            $this->column('created_at',__('Received At')),
        ];
    }
    
    protected function customColumns(): array
    {
        return [
            'resume'    =>  fn($model) => '<a download href="'.Str::replace('http://','https://',$model->getFirstMediaUrl()).'"><i class="fa fa-download"></i></a>',
            'created_at'    =>  fn($model) => $model->created_at->format('Y-m-d h:ia')
        ];
    }
}

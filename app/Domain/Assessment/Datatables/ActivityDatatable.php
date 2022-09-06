<?php

namespace App\Domain\Assessment\Datatables;

use App\Domain\Assessment\Models\Activity;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class ActivityDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return Activity::with('field')->orderBy('id','DESC');
    }

    protected function columns(): array
    {
        return [
            $this->column('id',__('ID')),
            $this->column('title.en',__('Title')),
            $this->column('description.en',__('Description')),
            $this->column('description.en',__('Description')),
            $this->column('field',__('Field')),
        ];
    }

    protected function customColumns(): array
    {
        return [
            'field' =>  fn($model) => $model->field->name
        ];
    }
}
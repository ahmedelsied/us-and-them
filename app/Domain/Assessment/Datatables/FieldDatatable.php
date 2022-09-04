<?php

namespace App\Domain\Assessment\Datatables;

use App\Domain\Assessment\Models\Field;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;

class FieldDatatable extends BaseDatatable
{

    public function query(): Builder
    {
        return Field::query();
    }

    protected function columns(): array
    {
        return [
            $this->column('name.en',__('Name')),
            $this->column('description.en',__('Description')),
        ];
    }
}

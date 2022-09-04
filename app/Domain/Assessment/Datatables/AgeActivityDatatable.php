<?php

namespace App\Domain\Assessment\Datatables;

use App\Domain\Assessment\Models\AgeActivity;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class AgeActivityDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return AgeActivity::query();
    }

    protected function columns(): array
    {
        return [
            Column::make('')->title(__('')),
        ];
    }
}

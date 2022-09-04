<?php

namespace App\Http\Controllers\Dashboard\Assessment;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithDatatable;
use App\Support\Dashboard\Crud\WithDestroy;
use App\Support\Dashboard\Crud\WithForm;
use App\Support\Dashboard\Crud\WithStore;
use App\Support\Dashboard\Crud\WithUpdate;
use App\Domain\Assessment\Datatables\FieldDatatable;
use App\Domain\Assessment\Models\Field;
use App\Domain\Assessment\Enums\AssessmentPermissions;

class FieldController extends DashboardController
{
    use WithDatatable,  WithForm , WithStore ,WithUpdate , WithDestroy;

    protected string $name = 'Field';
    protected string $path = 'dashboard.assessment.fields';
    protected string $datatable = FieldDatatable::class;
    protected string $model = Field::class;
    protected array $permissions = [AssessmentPermissions::class, 'fields'];


    protected function rules()
    {
        return [
            'name'  =>  'required|array|size:2',
            'name.*'  =>  'required|string|max:191',
            'description'  =>  'required|array|size:2',
            'description.*'  =>  'required|string|max:191',
        ];
    }

    public function show($field)
    {
        $field = Field::with(['age_activities' => fn($q) => $q->orderBy('index')])->findOrFail($field);
        return view($this->path.'.show',['field' => $field]);
    }

}

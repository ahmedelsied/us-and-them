<?php

namespace App\Http\Controllers\Dashboard\Assessment;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithDestroy;
use App\Domain\Core\Enums\CorePermissions;
use App\Support\Dashboard\Crud\WithStore;
use App\Support\Dashboard\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Assessment\Datatables\AgeActivityDatatable;
use App\Domain\Assessment\Models\AgeActivity;
use App\Http\Resources\AgeActivityResource;
use Batch;
use Illuminate\Http\Request;

class AgeActivityController extends DashboardController
{
    use WithStore ,WithUpdate , WithDestroy;

    protected string $name = 'AgeActivity';
    protected string $path = 'dashboard.assessment.age-activities';
    protected string $datatable = AgeActivityDatatable::class;
    protected string $model = AgeActivity::class;
    protected array $permissions = [CorePermissions::class, 'age_activities'];


    protected function rules()
    {
        return [
            'title.en'  =>  'required|string',
            'title.ar'  =>  'required|string',
            'field_id'  =>  'required|exists:fields,id'
        ];
    }

    protected function storeAction(array $validated)
    {
        $model = ($this->model)::create($validated);

        return new AgeActivityResource($model);
    }
    
    protected function updateAction(array $validated, Model $model)
    {
        $model->update($validated);

        return new AgeActivityResource($model);
    }

    public function show($ageActivity)
    {
        $ageActivity = AgeActivity::with(['activities' => function($q){
            return $q->orderBy('index');
        }])->findOrFail($ageActivity);

        return view($this->path.'.show')->with([
            'ageActivity'   =>  $ageActivity,
            'activities'    =>  $ageActivity->activities
        ]);
    }

    public function saveSorting(Request $request)
    {

        $ageActivityModel = new AgeActivity;
        $activities = [];
        foreach(($request->ageActivitiesIds ?? []) as $index => $id){
            $activities[] = [
                'id' => $id,
                'index' => $index,
                'field_id' => $request->field_id
            ];
        }

        Batch::update($ageActivityModel, $activities, 'id');
    }
}

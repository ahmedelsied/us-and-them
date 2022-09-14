<?php

namespace App\Http\Controllers\Dashboard\Assessment;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithDatatable;
use App\Support\Dashboard\Crud\WithDestroy;
use App\Support\Dashboard\Crud\WithForm;
use App\Support\Dashboard\Crud\WithStore;
use App\Support\Dashboard\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Assessment\Datatables\ActivityDatatable;
use App\Domain\Assessment\Enums\AssessmentPermissions;
use App\Domain\Assessment\Models\Activity;
use App\Domain\Assessment\Models\AgeActivity;
use App\Domain\Assessment\Models\Field;
use Arr;
use Batch;
use Illuminate\Http\Request;
use App\Http\Requests\Assessment\ActivityRequest;
class ActivityController extends DashboardController
{
    use WithDatatable,  WithForm , WithStore ,WithUpdate , WithDestroy;

    protected string $name = 'Activity';
    protected string $path = 'dashboard.assessment.activities';
    protected string $datatable = ActivityDatatable::class;
    protected string $model = Activity::class;
    protected array $permissions = [AssessmentPermissions::class, 'activities'];
    protected array $files = [
        'activity_one_media'    =>  'activity_one_media',
        'activity_two_media'    =>  'activity_two_media',
    ];

    protected function validationAction(): array
    {
        return app(ActivityRequest::class)->validated();
    }

    public function saveSorting(Request $request)
    {
        $activityModel = new Activity;
        $activities = [];
        foreach(($request->activitiesIds ?? []) as $index => $id){
            $activities[] = [
                'id' => $id,
                'index' => $index,
            ];
        }

        Batch::update($activityModel, $activities, 'id');
    }

    public function getFields(AgeActivity $ageActivity)
    {
        $ageActivity = $ageActivity->findOrFail(request('age-activity-id'));
        return Field::where('age_activity_id',$ageActivity->id)->get();
    }

    protected function formData(?Model $model = null): array
    {
        if($model != null){
            return [
                'fields'    =>  toMap(Field::where('age_activity_id',$model->field->age_activity_id)->get())
            ];
        }

        return [
            'ageActivities' =>  toMap(AgeActivity::all(),'id','title')
        ];
    }
}

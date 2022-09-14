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


    protected function rules()
    {
        $rules = [
            'title'                         =>  'required|array|size:2', 
            'title.*'                       =>  'required|string|max:191',
            'activity_one_description'      =>  'required|array|size:2',
            'activity_one_description.*'    =>  'required|string|max:191',
            'activity_two_description'      =>  'required|array|size:2',
            'activity_two_description.*'    =>  'required|string|max:191',
            'field_id'                      =>  'required|numeric|exists:fields,id',
            'activity_one_video_url'        =>  'nullable|url',
            'activity_two_video_url'        =>  'nullable|url',
            'activity_one_media'            =>  'required_without:activity_one_video_url|image|max:5000',
            'activity_two_media'            =>  'required_without:activity_two_video_url|image|max:5000',
        ];

        if(request()->isMethod('PUT')){
            $rules['activity_one_media'] = 'nullable:activity_one_video_url|image|max:5000';
            $rules['activity_two_media'] = 'nullable:activity_one_video_url|image|max:5000';
        }

        return $rules;
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

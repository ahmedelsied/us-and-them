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


    protected function rules()
    {
        return [
            'title'             =>  'required|array|size:2', 
            'description'       =>  'required|array|size:2', 
            'title.*'           =>  'required|string|max:191', 
            'description.*'     =>  'required|string|max:191',
            'field_id'          =>  'required|numeric|exists:fields,id',
            'media'             =>  'nullable|mimes:mp4,mov,ogg,qt,jpg,jpeg,png,bmp,tiff|max:10000',
        ];
    }

    protected function storeAction(array $validated)
    {
        $media = null;
        if(Arr::has($validated,'media')){
            $media = Arr::pull($validated,'media');
        }
        $model = ($this->model)::create($validated);

        if(!is_null($media)){
            $model->addMedia($media)->toMediaCollection();
        }
    }

    protected function updateAction(array $validated, Model $model)
    {
        if(Arr::has($validated,'media')){
            $media = Arr::pull($validated,'media');
            $model->clearMediaCollection();
            $model->addMedia($media)->toMediaCollection();
        }
        $model->update($validated);

        return null;
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

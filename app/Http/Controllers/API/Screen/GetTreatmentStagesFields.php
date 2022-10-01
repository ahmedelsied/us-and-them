<?php

namespace App\Http\Controllers\API\Screen;

use App\API\Http\Controllers\APIController;
use App\Http\Resources\API\Assessment\AgeActivityResource;
use App\Support\Dashboard\Crud\WithInvoke;

class GetTreatmentStagesFields extends APIController
{
    use WithInvoke;
    
    protected function invokeAction(array $validated)
    {
        $stageFields = auth()->user()->getStageFields($validated['age_activity_id']);
        return $this->success(new AgeActivityResource($stageFields));
    }

    protected function rules()
    {
        return [
            'age_activity_id'   =>  'required|exists:age_activities,id'
        ];
    }
}

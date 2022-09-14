<?php

namespace App\Http\Controllers\API\Data;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\Activity;
use App\Domain\Assessment\Models\Field;
use App\Http\Resources\API\Assessment\ActivityResource;

class GetActivities extends APIController
{
    public function __invoke(Field $field)
    {
        $activities = Activity::whereFieldId($field->id)->with('user_answer')->orderBy('index','ASC')->paginate();

        return $this->success(ActivityResource::paginate($activities));
    }
    
}

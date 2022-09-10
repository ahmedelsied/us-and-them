<?php

namespace App\Http\Controllers\API\Data;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\Activity;
use App\Domain\Assessment\Models\Field;
use App\Http\Resources\API\Assessment\ActivityResource;
use Codebase\API\Support\Services\APIResponse\ApiResponse;

class GetActivities extends APIController
{
    public function __invoke(Field $field)
    {
        $activities = Activity::whereFieldId($field->id)->with('user_answer')->paginate();

        return ApiResponse::success(ActivityResource::paginate($activities));
    }
    
}

<?php

namespace Codebase\API\Http\Controllers\Domains\Workouts;

use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Resources\Workouts\WeightLogResource;
use Codebase\Workout\Models\WorkoutWeightLog;
use Illuminate\Http\Request;

class AddNewWeightLogController extends APIController
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'exercise_id'   =>  'required|integer|exists:exercises,id',
            'weight'   =>  'required|integer|max:99999',
            'repeats'   =>  'required|integer|max:99999',
            'log_date'   =>  'required|date',
        ],$request->all());


        $log = WorkoutWeightLog::create((['client_id' =>  auth()->id()] + $validated));

        return $this->success(new WeightLogResource($log));
    }
}
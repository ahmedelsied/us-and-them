<?php

namespace Codebase\API\Http\Controllers\Domains\Workouts;

use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Resources\Workouts\WeightLogResource;
use Codebase\Workout\Models\WorkoutWeightLog;
use Illuminate\Http\Request;

class GetClientWeightLogController extends APIController
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'exercise_id'    =>  'required|integer|exists:exercises,id',
            'workout_day_id' =>  'required|integer|exists:workout_days,id',
        ],$request->all());

        $clientLog = WorkoutWeightLog::where('client_id',auth()->id())
                                     ->where('exercise_id',$validated['exercise_id'])
                                     ->where('workout_day_id',$validated['workout_day_id']);
        
        return $this->success(WeightLogResource::collection($clientLog->get()));

    }
}
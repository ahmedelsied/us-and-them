<?php

namespace Codebase\API\Http\Controllers\Domains\Workouts;

use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Resources\Workouts\WorkoutTypeResource;
use Codebase\Workout\Models\Workout;
use Illuminate\Http\Request;

class GetWorkoutTypesController extends APIController
{
    public function __invoke(Request $request)
    {
        $workouts = Workout::selectRaw('DISTINCT(`type`),workouts.*')
                           ->orderBy('id','DESC')
                           ->where('client_id',auth()->id())
                           ->latest('type')
                           ->get()
                           ->unique('type');

        return $this->success(WorkoutTypeResource::collection($workouts));
    }
}
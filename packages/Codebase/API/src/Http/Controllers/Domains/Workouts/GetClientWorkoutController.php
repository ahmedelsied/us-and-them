<?php

namespace Codebase\API\Http\Controllers\Domains\Workouts;

use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Resources\Workouts\WorkoutResource;
use Codebase\Workout\Models\Workout;
use Illuminate\Http\Request;

class GetClientWorkoutController extends APIController
{
    public function __invoke(Request $request,$workout)
    {
        $workout = Workout::with([
            'days',
            'days.sections',
            'days.sections.technique',
            'days.sections.allExercises',
            'days.sections.allExercises.muscles',
            'days.sections.allExercises.tools',
            'days.sections.allExercises.media',
        ])->findOrFail($workout);

        return $this->success(new WorkoutResource($workout));
    }
}
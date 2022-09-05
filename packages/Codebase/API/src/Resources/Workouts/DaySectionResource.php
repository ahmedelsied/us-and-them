<?php

namespace Codebase\API\Resources\Workouts;

use Illuminate\Http\Resources\Json\JsonResource;

class DaySectionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'reps'          =>  $this->reps,
            'sets'          =>  $this->sets,
            'rest'          =>  $this->rest,
            'rpe'           =>  $this->rpe,
            'notes'         =>  $this->notes,
            'technique'     =>  $this->technique,
            'exercises'     =>  ExerciseResource::collection($this->allExercises)
        ];
    }
}
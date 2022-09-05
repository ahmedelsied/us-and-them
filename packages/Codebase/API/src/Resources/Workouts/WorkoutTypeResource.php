<?php

namespace Codebase\API\Resources\Workouts;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'type'          =>  $this->type,
            'title'         =>  $this->title,
        ];
    }
}
<?php

namespace Codebase\API\Resources\Workouts;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutDayResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'day_number'    =>  $this->day_number,
            'week_number'   =>  $this->week_number,
            'type'          =>  $this->type,
            'sections'      =>  DaySectionResource::collection($this->sections)
        ];
    }
}
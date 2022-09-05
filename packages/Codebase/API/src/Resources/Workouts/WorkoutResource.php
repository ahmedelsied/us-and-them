<?php

namespace Codebase\API\Resources\Workouts;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'title'         =>  $this->title,
            'type'          =>  $this->type,
            'selected_day'  =>  Carbon::tomorrow()->dayOfWeek,
            'days'          =>  WorkoutDayResource::collection($this->days)
        ];
    }
}
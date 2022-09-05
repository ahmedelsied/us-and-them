<?php

namespace Codebase\API\Resources\Workouts;

use Illuminate\Http\Resources\Json\JsonResource;

class WeightLogResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'exercise_id'   =>  $this->exercise_id,
            'weight'        =>  $this->weight,
            'repeats'       =>  $this->repeats,
            'log_date'      =>  $this->log_date,
        ];
    }
}
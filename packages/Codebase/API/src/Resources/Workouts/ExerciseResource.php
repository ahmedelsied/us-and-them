<?php

namespace Codebase\API\Resources\Workouts;

use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{

    public function toArray($request)
    {
        WorkoutDayResource::class;
        return [
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'isolated'      =>  $this->isolated,
            'test_volume'   =>  $this->test_volume,
            'muscles'       =>  $this->muscles,
            'tools'         =>  $this->tools,
            'alternatives'  =>  $this->alternatives,
            'active'        =>  $this->active,
            'thumbnail'     =>  $this->thumbnail,
            'media'         =>  $this->getMedia(),
            'videos'        =>  $this->videos,
        ];
    }
}
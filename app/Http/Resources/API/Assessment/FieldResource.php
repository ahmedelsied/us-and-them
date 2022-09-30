<?php

namespace App\Http\Resources\API\Assessment;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return    [
            'id'                =>  $this->id,
            'name'              =>  $this->name,
            'description'       =>  $this->description,
            'total_activities'  =>  $this->activities_count,
            'user_answers'      =>  $this->user_answers_count
        ];
    }
}

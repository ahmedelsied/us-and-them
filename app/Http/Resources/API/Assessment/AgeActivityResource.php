<?php

namespace App\Http\Resources\API\Assessment;

use Illuminate\Http\Resources\Json\JsonResource;

class AgeActivityResource extends JsonResource
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
            'id'        =>  $this->id,
            'title'     =>  $this->title,
            'fields'    =>  $this->whenLoaded('fields',function(){
                return FieldResource::collection($this->fields);
            })
        ];
    }
}

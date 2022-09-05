<?php

namespace Codebase\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'title'         =>  $this->title,
            'description'   =>  $this->description,
            'type'          =>  $this->type,
            'questions'     =>  AssessmentQuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}
<?php

namespace Codebase\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentQuestionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'question'      =>  $this->question,
            'type'          =>  $this->type,
            'choices'       =>  collect($this->choices)->transform(function($item){
                                    return $item[app()->getLocale()];
                                })
        ];
    }
}
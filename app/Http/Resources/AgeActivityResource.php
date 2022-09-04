<?php

namespace App\Http\Resources;

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
            'title'     =>  [
                'en'    =>  $this->getTranslation('title','en'),
                'ar'    =>  $this->getTranslation('title','ar')
            ],
            'field_id'  =>  $this->field_id,
            'index'     =>  $this->index,
            'deleteUrl' =>  route('dashboard.assessment.age-activities.destroy',$this->id),
            'editUrl'   =>  route('dashboard.assessment.age-activities.update',$this->id),
            'showUrl'   =>  route('dashboard.assessment.age-activities.show',$this->id),
        ];
    }
}

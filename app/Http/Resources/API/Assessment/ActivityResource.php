<?php

namespace App\Http\Resources\API\Assessment;

use App\Support\Traits\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    use WithPagination;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $activity_one_url = $this->getFirstMediaUrl('activity_one');
        $activity_two_url = $this->getFirstMediaUrl('activity_two');

        return    [
            'id'                        =>  $this->id,
            'title'                     =>  $this->title,
            'description'               =>  $this->description,
            'suggested_activites'       =>  [
                                                [
                                                    'title'  =>  $this->activity_one_title,
                                                    'description'       => $this->activity_one_description,
                                                    'media' =>  [
                                                        'type'   => 'image',
                                                        'url'   => $activity_one_url,
                                                    ]
                                                ],
                                                [
                                                    'title'  =>  $this->activity_two_title,
                                                    'description'       => $this->activity_two_description,
                                                    'media' =>  [
                                                        'type'   => 'image',
                                                        'url'   => $activity_two_url,
                                                    ]
                                                ]
                                            ],
            'passed'                    =>  $this->user_answer?->passed
        ];
    }
}

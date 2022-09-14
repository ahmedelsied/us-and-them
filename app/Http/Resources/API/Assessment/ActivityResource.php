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
        $activity_one_url = $this->getFirstMediaUrl('activity_one_media') ?? $this->activity_one_video_url;
        $activity_two_url = $this->getFirstMediaUrl('activity_two_media') ?? $this->activity_two_video_url;
        $typeOne = $this->activity_one_video_url == $activity_one_url ? 'video' : 'image';
        $typeTwo = $this->activity_two_video_url == $activity_two_url ? 'video' : 'image';

        return    [
            'id'                        =>  $this->id,
            'title'                     =>  $this->title,
            'suggested_activites'       =>  [
                                                [
                                                    'description'       => $this->activity_one_description,
                                                    'media' =>  [
                                                        'type'  =>  $typeOne,
                                                        'url'   =>  $activity_one_url,
                                                    ]
                                                ],
                                                [
                                                    'description'       => $this->activity_two_description,
                                                    'media' =>  [
                                                        'type'  =>  $typeTwo,
                                                        'url'   =>  $activity_two_url,
                                                    ]
                                                ]
                                            ],
            'passed'                    =>  $this->user_answer?->passed
        ];
    }
}

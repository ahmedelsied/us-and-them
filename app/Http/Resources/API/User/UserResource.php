<?php

namespace App\Http\Resources\API\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                    =>  $this->id,
            'name'                  =>  $this->name,
            'email'                 =>  $this->email,
            'birthdate'             =>  $this->information?->birthdate->format('Y-m-d'),
            'mental_age'            =>  $this->information?->mental_age,
            'neurologists_disease'  =>  $this->information?->neurologists_disease,
            'estimated_mental_age'  =>  $this->information?->estimated_mental_age,
            'is_patient'            =>  $this->information?->is_patient,
            'checkpoint'            =>  $this->information?->checkpoint ?? 'CHECKPOINT_APPLICATION',
            'token'                 =>  $this->token ?? $request->bearerToken(),
            'age_activity'          =>  null
        ];
    }
}

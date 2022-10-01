<?php

namespace App\Http\Controllers\API\Data;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\Activity;
use App\Domain\Assessment\Models\Field;
use App\Domain\Core\Enums\Checkpoints;
use App\Http\Resources\API\Assessment\ActivityResource;

class GetActivities extends APIController
{
    private $user;
    public function __invoke(Field $field)
    {
        $this->user = auth()->user();

        if($this->allowedCheckpoint()){

            $activities = Activity::whereFieldId($field->id)
                                  ->with(['user_answer' => function($q){
                                    if(request()->has('phase')){
                                        $q->wherePhase(request('phase'));
                                    }
                                    return $q->whereUserId(auth()->id());
                                  }])
                                  ->orderBy('index','ASC')
                                  ->paginate();

            return $this->success(ActivityResource::paginate($activities));
        }

        return $this->error(__('Wrong Checkpoint'));
    }

    private function allowedCheckpoint()
    {
        return $this->user->checkpoint == Checkpoints::test()->value || $this->user->checkpoint == Checkpoints::treatment()->value;
    }
    
}

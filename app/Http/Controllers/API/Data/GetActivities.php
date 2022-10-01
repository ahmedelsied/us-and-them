<?php

namespace App\Http\Controllers\API\Data;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\Activity;
use App\Domain\Assessment\Models\Field;
use App\Domain\Core\Enums\Checkpoints;
use App\Http\Resources\API\Assessment\ActivityResource;

class GetActivities extends APIController
{
    public function __invoke(Field $field)
    {
        $user = auth()->user();

        if($user->checkpoint == Checkpoints::test()->value){

            $activities = Activity::whereFieldId($field->id)
                                  ->with(['user_answer' => fn($q) => $q->whereUserId(auth()->id()) ])
                                  ->orderBy('index','ASC')
                                  ->paginate();

            return $this->success(ActivityResource::paginate($activities));
        }

        return $this->error(__('Wrong Checkpoint'));
    }
    
}

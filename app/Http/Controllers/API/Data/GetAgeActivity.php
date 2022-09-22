<?php

namespace App\Http\Controllers\API\Data;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Enums\Checkpoints;
use App\Http\Resources\API\Assessment\AgeActivityResource;

class GetAgeActivity extends APIController
{
    public function __invoke()
    {
        $user = auth()->user();
        if($user->checkpoint == Checkpoints::test()->value){
            return $this->success(new AgeActivityResource($user->getAgeActivity()));
        }
        return $this->error(__('Wrong Checkpoint'));
    }
    
}

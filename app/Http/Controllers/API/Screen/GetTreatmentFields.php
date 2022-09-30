<?php

namespace App\Http\Controllers\API\Screen;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\AgeActivity;
use App\Domain\Core\Enums\Checkpoints;
use App\Domain\Core\Enums\Phases;
use App\Http\Resources\API\Assessment\AgeActivityResource;

class GetTreatmentFields extends APIController
{
    private $user;
    public function __invoke()
    {
        $this->user = auth()->user();
        if($this->user->checkpoint != Checkpoints::treatment()->value){
            return $this->error(__('Wrong Checkpoint'));
        }

        return $this->success(AgeActivityResource::collection($this->getStages()));
    }

    private function getStages()
    {
        return AgeActivity::where('id','>=',$this->user->information?->treatment_age_activity)
                          ->with([
                                'fields'    =>  fn($q) => $q->where('id','>=',$this->user->information?->ceil_field_id)
                                                            ->withCount(['activities','user_answers' => fn($q) => $q->wherePhase(Phases::treatment()->value)->whereUserId($this->user->id)])])
                          ->get();
    }
}

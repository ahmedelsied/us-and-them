<?php

namespace App\Http\Controllers\API\Data;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\AgeActivity;
use App\Domain\Assessment\Models\UserActivityAnswer;
use App\Domain\Core\Enums\Checkpoints;
use App\Domain\Core\Enums\Phases;
use App\Http\Resources\API\Assessment\AgeActivityResource;

class GetTreatmentFields extends APIController
{
    public function __invoke()
    {
        $this->user = auth()->user();
        if($this->user->checkpoint != Checkpoints::treatment()->value){
            return $this->error(__('Wrong Checkpoint'));
        }
        $userTreatmentAgeActivity = $this->user->information?->treatment_age_activity;
        if(is_null($userTreatmentAgeActivity)){
            $userTreatmentAgeActivity = $this->setUserTreatmentAgeActivity();
        }

        return $this->success(new AgeActivityResource($this->treatmentFields($userTreatmentAgeActivity)));

    }

    private function setUserTreatmentAgeActivity()
    {
        $answers = UserActivityAnswer::with('age_activity')
                                         ->wherePhase(Phases::assessment()->value)
                                         ->whereUserId(auth()->id())
                                         ->wherePassed(false)
                                         ->orderBy('age_activity_id','desc')
                                         ->first();

            $this->user->information()->update([
                'treatment_age_activity' => $answers->age_activity->id
            ]);
            return $answers->age_activity->id;
    }

    private function treatmentFields($userTreatmentAgeActivity)
    {
        $answers = UserActivityAnswer::distinct('field_id')
                                        ->with('field')
                                         ->wherePhase(Phases::assessment()->value)
                                         ->whereUserId(auth()->id())
                                         ->whereAgeActivityId($userTreatmentAgeActivity)
                                         ->wherePassed(false)
                                         ->get(['field_id']);
        $fields = $answers->pluck('field_id')->all();
        $ageActivity = AgeActivity::whereId($userTreatmentAgeActivity)->with(['fields' => fn($q) => $q->whereIn('id',$fields)])->first();

        return $ageActivity;
    }
}

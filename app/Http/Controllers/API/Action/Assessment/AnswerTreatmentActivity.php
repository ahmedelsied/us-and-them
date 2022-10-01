<?php

namespace App\Http\Controllers\API\Action\Assessment;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\AgeActivity;
use App\Domain\Assessment\Models\Field;
use App\Domain\Assessment\Models\UserActivityAnswer;
use App\Domain\Core\Enums\Checkpoints;
use App\Domain\Core\Enums\Phases;
use App\Http\Resources\API\Assessment\AgeActivityResource;
use App\Support\Dashboard\Crud\WithInvoke;

class AnswerTreatmentActivity extends APIController
{
    use WithInvoke;
    private $user;
    private $validated;
    private $field;
    private $ageActvityId;

    protected function invokeAction(array $validated)
    {
        $this->validated = $validated;
        $this->user = auth()->user();
        $this->field = Field::find($validated['field_id']);
        $this->ageActvityId = $this->field->age_activity_id;
        if($this->user->checkpoint != Checkpoints::treatment()->value){
            return $this->error(__('Wrong Checkpoint'),400,['checkpoint' => $this->user->checkpoint]);
        }
        if($this->alreadyAnswered()){
            $stages = AgeActivity::where('id','>=',$this->user->information?->treatment_age_activity)
                          ->get();
            return $this->error(__('You\'ve already answered this activity before'),400,AgeActivityResource::collection($stages));
        }

        if($this->lastActivityInTreatment()){
            $this->user->information?->update([
                'checkpoint'    =>  Checkpoints::end()->value
            ]);
            $this->storeActivityAnswer();
            return $this->success([
                'message' => __('Finished App'),
                'checkpoint' => Checkpoints::end()->value,
            ]);
        }

        return $this->storeActivityAnswer();
    }

    private function alreadyAnswered()
    {
        return UserActivityAnswer::wherePhase(Phases::treatment()->value)
                                 ->whereUserId(auth()->id())
                                 ->whereActivityId($this->validated['activity_id'])
                                 ->whereFieldId($this->validated['field_id'])
                                 ->exists();
    }

    private function lastActivityInTreatment()
    {
        $ceilFieldId = $this->user->information?->ceil_field_id;
        $treatmentAgeActivity = $this->user->information?->treatment_age_activity;

        $activities = Field::where('id','>=',$ceilFieldId)
                           ->where('age_activity_id','>=',$treatmentAgeActivity)
                           ->count();

        $answers = UserActivityAnswer::wherePhase(Phases::treatment()->value)
                                     ->where('field_id','>=',$ceilFieldId)
                                     ->where('age_activity_id','>=',$treatmentAgeActivity)
                                     ->whereUserId(auth()->id())
                                     ->count();
        return ($activities-1) == $answers;
    }

    private function storeActivityAnswer()
    {
        $this->user->answers_log()->create([
            'activity_id'       =>  $this->validated['activity_id'],
            'field_id'          =>  $this->validated['field_id'],
            'age_activity_id'   =>  $this->ageActvityId,
            'phase'             =>  Phases::treatment()->value,
            'passed'            =>  true,
        ]);

        if($this->lastActivityInThisStage()){
            $treatmentAgeActivity = (1+$this->user->information?->treatment_age_activity);
            $this->user->information?->update([
                'treatment_age_activity'    =>  $treatmentAgeActivity
            ]);
            return $this->success(AgeActivityResource::collection($this->getStages()));
        }

        return $this->success(['message' => __('Request Executed Successfully')]);

    }

    private function lastActivityInThisStage()
    {        
        $ceilFieldId = $this->user->information?->ceil_field_id;
        $treatmentAgeActivity = $this->user->information?->treatment_age_activity;

        $activities = Field::where('id','>=',$ceilFieldId)
                           ->where('age_activity_id',$treatmentAgeActivity)
                           ->count();

        $answers = UserActivityAnswer::wherePhase(Phases::treatment()->value)
                                     ->where('field_id','>=',$ceilFieldId)
                                     ->where('age_activity_id',$treatmentAgeActivity)
                                     ->whereUserId(auth()->id())
                                     ->count();

        return ($activities-1) == $answers;
    }

    private function getStages()
    {
        return AgeActivity::where('id','>=',$this->user->information?->treatment_age_activity)
                          ->get();
    }
    protected function rules()
    {
        return [
            'activity_id'   =>  'required|exists:activities,id',
            'field_id'      =>  'required|exists:fields,id',
        ];
    }

}

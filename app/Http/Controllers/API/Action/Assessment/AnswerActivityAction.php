<?php

namespace App\Http\Controllers\API\Action\Assessment;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\Field;
use App\Domain\Assessment\Models\UserActivityAnswer;
use App\Domain\Core\Enums\Checkpoints;
use App\Http\Resources\API\Assessment\AgeActivityResource;
use App\Support\Dashboard\Crud\WithInvoke;

class AnswerActivityAction extends APIController
{
    use WithInvoke;
    private $user;
    private $validated;
    private $userAgeActivity;
    private $countOfLastPassedAnswers;

    protected function invokeAction(array $validated)
    {
        $this->validated = $validated; 
        $this->user = auth()->user(); 
        $this->userAgeActivity = $this->user->information?->current_age_activity;
        if($this->notAllowedToAnswerThisField()){
            return $this->error(['message' => __('This age activity has been closed and we will show your result')]);
        }

        if($this->alreadyAnsweredActivity($this->validated['activity_id'])){
            $userAgeActivity = new AgeActivityResource($this->user->getAgeActivity());
            return $this->error(__('You\'ve already answered this activity before'),400,$userAgeActivity);
        }

        $answer = $this->user->answers_log()->create([
                                    'age_activity_id'   => $this->userAgeActivity
                                    ] + 
                                    $this->validated);

        return $this->handleResponse($answer);
    }

    private function notAllowedToAnswerThisField()
    {
        $lastFiveAnswers = UserActivityAnswer::whereUserId(auth()->id())
                                             ->whereFieldId($this->validated['field_id'])
                                             ->whereAgeActivityId($this->userAgeActivity)
                                             ->limit(5)
                                             ->orderBy('id','DESC')
                                             ->get()
                                             ->pluck('passed')->all();
        $this->countOfLatestAnswers = count($lastFiveAnswers);
        $this->countOfLastPassedAnswers = count(array_filter($lastFiveAnswers));
        return $this->countOfLatestAnswers == 5 && $this->countOfLastPassedAnswers == 0;
    }

    private function alreadyAnsweredActivity($activityId)
    {
        return UserActivityAnswer::whereUserId(auth()->id())->whereActivityId($activityId)->exists();
    }

    private function handleResponse($answer)
    {
        if($this->countOfLatestAnswers >= 4 && (($this->countOfLastPassedAnswers == 0 || $this->countOfLastPassedAnswers == 1) && !$answer->passed )){
            return $this->closeTestPhase();
        }

        $countOfActivities = Field::whereAgeActivityId(($this->userAgeActivity))
                                  ->withCount('activities')
                                  ->get()
                                  ->pluck('activities_count')->all();

        $countOfActivities = array_sum($countOfActivities);
        $countOfAnswers = UserActivityAnswer::whereAgeActivityId($this->userAgeActivity)
                                            ->where('user_id',auth()->id())
                                            ->count();
        if($countOfActivities == $countOfAnswers){
            if($this->userAgeActivity == 5){
                $this->user->updateCheckpoint(Checkpoints::end()->value);
                return $this->success(['message' => 'Congratulations you\'ve passed all age activities!']);
            }

            $this->user->information?->update(['current_age_activity' => (++$this->userAgeActivity)]);
            $this->user->refresh();
            return $this->success(new AgeActivityResource($this->user->getAgeActivity()));
        }

        return $this->success(['message' => 'Request Executed Successfully']);
    }

    private function closeTestPhase()
    {
        $this->user->updateCheckpoint(Checkpoints::result()->value);
        $this->user->information?->update([
            'treatment_age_activity'    => $this->userAgeActivity,
            'ceil_field_id'             => $this->validated['field_id']
        ]);
        return $this->success(['message' => 'Success And Age Activity Closed']);
    }

    protected function rules()
    {
        return [
            'activity_id'   =>  'required|exists:activities,id',
            'field_id'      =>  'required|exists:fields,id',
            'passed'        =>  'required|boolean'        
        ];
    }

}

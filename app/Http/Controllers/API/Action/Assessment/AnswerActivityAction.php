<?php

namespace App\Http\Controllers\API\Action\Assessment;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\Activity;
use App\Domain\Assessment\Models\Field;
use App\Domain\Assessment\Models\UserActivityAnswer;
use App\Domain\Core\Enums\Checkpoints;
use App\Http\Resources\API\Assessment\AgeActivityResource;
use App\Support\Dashboard\Crud\WithInvoke;

class AnswerActivityAction extends APIController
{
    use WithInvoke;
    private $userAgeActivity;
    private $countOfLastPassedAnswers;

    protected function invokeAction(array $validated)
    {
        $this->user = auth()->user(); 
        $this->userAgeActivity = $this->user->information?->current_age_activity;
        if($this->notAllowedToAnswerThisField($validated)){
            return $this->error(__('This age activity has been closed and we will show your result'));
        }

        if($this->alreadyAnsweredActivity($validated['activity_id'])){
            $userAgeActivity = new AgeActivityResource($this->user->getAgeActivity());
            return $this->error(__('You\'ve already answered this activity before'),400,$userAgeActivity);
        }

        $answer = UserActivityAnswer::create([
                                    'user_id'   =>  auth()->id(),
                                    'age_activity_id'   =>  $this->userAgeActivity
                                    ] + 
                                    $validated);

        return $this->handleResponse($answer);
    }
    
    private function notAllowedToAnswerThisField($validated)
    {
        $lastFiveAnswers = UserActivityAnswer::whereUserId(auth()->id())
                                             ->whereFieldId($validated['field_id'])
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
        if($this->countOfLatestAnswers == 4 && $this->countOfLastPassedAnswers == 0 && !$answer->passed){
            $this->user->updateCheckpoint(Checkpoints::result()->value);
            return $this->success('Success And Age Activity Closed');
        }

        $countOfActivities = Field::withCount('activities')
                                  ->whereAgeActivityId($this->userAgeActivity)
                                  ->get()
                                  ->pluck('activities_count')->all();

        $countOfActivities = array_sum($countOfActivities);
        $countOfAnswers = UserActivityAnswer::whereAgeActivityId($this->userAgeActivity)->whereUserId(auth()->id())->count();

        if($countOfActivities == $countOfAnswers){
            if($this->userAgeActivity == 5){
                return $this->success('Congratulations you\'ve passed all age activities!');
            }else{
                $this->user->information?->update(['current_age_activity' => (++$this->userAgeActivity)]);
                return $this->success(new AgeActivityResource($this->user->getAgeActivity()));
            }
        }
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

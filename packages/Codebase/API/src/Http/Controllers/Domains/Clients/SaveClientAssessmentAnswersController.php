<?php

namespace Codebase\API\Http\Controllers\Domains\Clients;

use App\Domain\Client\Models\ClientAssessmentAnswer;
use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Http\Requests\SaveClientAnswersRequest;

class SaveClientAssessmentAnswersController extends APIController
{
    public function __invoke(SaveClientAnswersRequest $request)
    {
        $validated = $request->validated();
        $answer = ClientAssessmentAnswer::where('client_id',auth()->id())
                              ->where('assessment_id',$validated['assessment_id'])
                              ->where('assessment_question_id',$validated['question_id'])
                              ->first();
        if($answer !== null){
            $answer->update([
                'answer' => $validated['answer']
            ]);
        }else{
            ClientAssessmentAnswer::create([
                'client_id'                 =>  auth()->id(),
                'assessment_id'             =>  $validated['assessment_id'],
                'assessment_question_id'    =>  $validated['question_id'],
                'answer'                    =>  $validated['answer'],
            ]);
        }

        return $this->executed();
    }
}
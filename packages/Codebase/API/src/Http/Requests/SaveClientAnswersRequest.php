<?php

namespace Codebase\API\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveClientAnswersRequest extends FormRequest
{
    public function rules()
    {
        return [
            'assessment_id' =>  'required|integer|exists:assessments,id',
            'question_id'   =>  'required|integer|exists:assessment_questions,id',
            'answer'        =>  'required|string'
        ];
    }
}
<?php

namespace App\Http\Requests\API\Web;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      =>  'required|string|max:100',
            'email'     =>  'required|email|max:100',
            'resume'    =>  'required|mimes:pdf,doc,docx|max:5000',
        ];
    }
}

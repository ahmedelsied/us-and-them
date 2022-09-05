<?php

namespace Codebase\API\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    
    protected function prepareForValidation()
    {
       $this->merge([
            'mobile'        =>  clean_phone($this->get('mobile'),$this->get('mobile_country')),
        ]);
    }

    public function rules()
    {
        return [
            'mobile'            =>  'required|string|max:32|phone:mobile_country|unique:clients,mobile',
            'mobile_country'    =>  'required_with:mobile',
            'name'              =>  'required|string|max:191',
            'otp'               =>  'sometimes|string|max:4'
        ];
    }

    public function messages()
    {
        return [
            'mobile.phone'  => __('Please Type A Valid Mobile Number')
        ];
    }
}
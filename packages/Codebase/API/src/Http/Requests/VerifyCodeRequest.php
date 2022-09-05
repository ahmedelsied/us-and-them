<?php

namespace Codebase\API\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest
{
    protected function prepareForValidation()
    {
       $this->merge([
            'mobile'        =>  clean_phone($this->get('mobile'),$this->get('mobile_country'))
        ]);

        if(!is_null($this->get('new_mobile'))){
            $this->merge([
                 'new_mobile'        =>  clean_phone($this->get('new_mobile'),$this->get('new_mobile_country'))
             ]);
        }
    }

    public function rules()
    {
        return [
            'mobile'                =>  'required|string|max:32|phone:mobile_country|exists:clients,mobile',
            'mobile_country'        =>  'required_with:mobile|string',
            'otp'                   =>  'required|string|max:4',
            'new_mobile'            =>  'sometimes|string|max:32|phone:new_mobile_country|unique:clients,mobile',
            'new_mobile_country'    =>  'required_with:new_mobile'
        ];
    }

    public function messages()
    {
        return [
            'mobile.phone'  => __('Please Type A Valid Mobile Number')
        ];
    }
}
<?php

namespace Codebase\API\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'              => 'sometimes|string',
            'image'             => 'sometimes|image|mimes:jpg,png|max:5000',
            'dob'               => 'sometimes|date',
            'email'             => 'sometimes|email|string|max:191|unique:clients,email,'.auth()->id(),
            'mobile'            => 'sometimes|string|max:32|phone:mobile_country|unique:clients,mobile,'.auth()->id(),
            'mobile_country'    => 'required_with:mobile|string|max:3'
        ];
    }

    public function messages()
    {
        return [
            'mobile.phone'  => __('Please Type A Valid Mobile Number')
        ];
    }
}
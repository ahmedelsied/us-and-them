<?php

namespace App\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
        
        $rules = [
            'title'                         =>  'required|array|size:2', 
            'title.*'                       =>  'required|string',
            'activity_one_description'      =>  'required|array|size:2',
            'activity_one_description.*'    =>  'required|string',
            'activity_two_description'      =>  'required|array|size:2',
            'activity_two_description.*'    =>  'required|string',
            'field_id'                      =>  'required|numeric|exists:fields,id',
            'activity_one_video_url'        =>  'nullable|url',
            'activity_two_video_url'        =>  'nullable|url',
            'activity_one_media'            =>  'required_without:activity_one_video_url|image|max:5000',
            'activity_two_media'            =>  'required_without:activity_two_video_url|image|max:5000',
        ];

        if(request()->isMethod('PUT')){
            $rules['activity_one_media'] = 'nullable:activity_one_video_url|image|max:5000';
            $rules['activity_two_media'] = 'nullable:activity_one_video_url|image|max:5000';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'title.en'                      =>  __('title en'),
            'title.ar'                      =>  __('title ar'),
            'activity_one_description.ar'   =>  __('activity one description ar'),
            'activity_one_description.en'   =>  __('activity one description en'),
            'activity_two_description.ar'   =>  __('activity two description ar'),
            'activity_two_description.en'   =>  __('activity two description en'),
        ];
    }
}

<?php

namespace App\Http\Controllers\API\Action\Auth;

use App\API\Http\Controllers\APIController;
use App\Support\Dashboard\Crud\WithInvoke;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UpdateProfileAction extends APIController
{
    use WithInvoke;
    private $data;
    private $user;
    private $correctPassword = true;
    protected function invokeAction(array $validated)
    {
        $this->user = auth()->user();
        $this->setProfileData($validated);
        if(!$this->correctPassword){
            return $this->error(__('Wrong Password'));
        }
        $this->user->update($this->data);
        return $this->executed();
    }

    private function setProfileData($validated)
    {
        if(Arr::has($validated,'name')){
            $this->data['name'] = $validated['name'];
        }

        if(Arr::has($validated,'old_password')){
            $this->correctPassword = Hash::check($validated['old_password'], $this->user->password);
            if($this->correctPassword){
                $this->data['password'] = Hash::make($validated['new_password']);
            }
        }
    }

    protected function rules()
    {
        return [
            'name'          =>  'nullable|string|max:191',
            'old_password'  =>  'nullable|string',
            'new_password'  =>  'required_with:old_password|string'
        ];
    }
    
}

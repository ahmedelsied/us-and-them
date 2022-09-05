<?php

namespace App\Http\Controllers\API\Action\Auth;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Models\Administration\User;
use App\Http\Resources\API\User\UserResource;
use App\Support\Dashboard\Crud\WithInvoke;
use Illuminate\Support\Facades\Auth;

class LoginAction extends APIController
{
    use WithInvoke;

    protected function invokeAction(array $validated)
    {
        if(Auth::attempt(['email'=>$validated['email'],'password'=>$validated['password']])){
            $user = User::with('information')->whereEmail($validated['email'])->first();
            Auth::login($user);
            $token = $user->createToken('api');
            $user->forceFill(['token' => $token->plainTextToken]);
            return $this->success(new UserResource($user));
        }

        return $this->error('Wrong credentials');

    }

    protected function rules()
    {
        return [
            'email' =>  'required|email',
            'password'  =>  'required|string'
        ];
    }
    
}

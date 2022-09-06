<?php

namespace App\Http\Controllers\API\Action\Auth;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Models\Administration\User;
use App\Http\Resources\API\User\UserResource;
use App\Support\Dashboard\Crud\WithInvoke;
use Hash;
use Illuminate\Support\Str;

class RegisterAction extends APIController
{

    use WithInvoke;

    protected function invokeAction(array $validated)
    {
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create([
            'phone'   =>  'app-user'.Str::random(5)] + $validated);
        $user->load('information');
        $token = $user->createToken('api');
        $user->forceFill(['token' => $token->plainTextToken]);
        return $this->success(new UserResource($user));
    }

    protected function rules()
    {
        return [
            'email'     =>  'required|email|unique:users',
            'password'  =>  'required|string',
            'name'      =>  'required|string'
        ];
    }
    
}

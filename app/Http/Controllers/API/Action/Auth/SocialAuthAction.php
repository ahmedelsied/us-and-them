<?php

namespace App\Http\Controllers\API\Action\Auth;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Models\Administration\User;
use App\Http\Resources\API\User\UserResource;
use App\Support\Dashboard\Crud\WithInvoke;
use Illuminate\Support\Str;

class SocialAuthAction extends APIController
{
    use WithInvoke;
    private $allowedPlatforms = ['huawei','google'];
    private $user;
    protected function invokeAction(array $validated)
    {
        if($this->isUserNotExists($validated)){
            $this->user = $this->newUser($validated);
        }

        $token = $this->user->createToken('api');
        $this->user->forceFill(['token' => $token->plainTextToken]);
        return $this->success(new UserResource($this->user));
    }

    private function isUserNotExists($validated)
    {
        $this->user = User::wherePlatform($validated['platform'])->whereUid($validated['uid'])->with('information')->first();
        return is_null($this->user);
    }

    private function newUser($validated)
    {
        $user = User::create([
            'name'    =>  'uat-user-'.Str::random(3)
            ] + $validated);
        $user->load('information');

        return $user;
    }

    protected function rules()
    {
        return [
            'uid'       =>  'required|string',
            'platform'  =>  'required|string|in:'.implode(',',$this->allowedPlatforms)
        ];
    }
    
}

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
        $this->isUserNotExists($validated) ?? $this->newUser($validated);

        $token = $this->user->createToken('api');
        $this->user->forceFill(['token' => $token->plainTextToken]);
        return $this->success(new UserResource($this->user));
    }

    private function isUserNotExists($validated)
    {
        $this->user = User::wherePlatform($validated['platform'])->whereUid($validated['uid'])->with('information')->first();
        return $this->user;
    }

    private function newUser($validated)
    {
        $this->user = User::create([
            'name'    =>  'uat-user-'.Str::random(3)
            ] + $validated);
        $this->user->load('information');
    }

    protected function rules()
    {
        return [
            'uid'       =>  'required|string',
            'platform'  =>  'required|string|in:'.implode(',',$this->allowedPlatforms)
        ];
    }
    
}

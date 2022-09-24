<?php

namespace App\Http\Controllers\API\Action\Auth;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Models\Administration\User;
use App\Support\Dashboard\Crud\WithInvoke;
use Hash;

class RestoreAccountAction extends APIController
{
    use WithInvoke;

    protected function invokeAction(array $validated)
    {
        $password = Hash::make($validated['password']);
        User::whereEmail($validated['email'])->update([
            'password' => $password
        ]);

        return $this->success(__('Your password has been reset successfully'));
    }

    protected function rules()
    {
        return [
            'email'     =>  'required|email|exists:users,email',
            'password'  =>  'required|string'
        ];
    }
    
}

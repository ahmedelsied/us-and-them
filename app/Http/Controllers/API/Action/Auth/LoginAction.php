<?php

namespace App\Http\Controllers\API\Action\Auth;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Models\Administration\User;
use App\Http\Resources\API\User\UserResource;
use App\Support\Dashboard\Crud\WithInvoke;
use Codebase\API\Support\Services\APIResponse\ApiResponse;

class LoginAction extends APIController
{
    // use WithInvoke;

    public function __invoke()
    {
        return ApiResponse::success(new UserResource(User::first()));
    }

    // protected function rules()
    // {
    //     return [
    //     ];
    // }
}

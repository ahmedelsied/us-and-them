<?php

namespace Codebase\API\Http\Controllers\Domains\Auth;

use App\Domain\Client\Models\Client;
use App\Domain\Client\Models\VerificationCode;
use App\Domain\Client\Resources\ClientResource;
use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Http\Requests\RegisterRequest;
use Str;

class RegisterController extends APIController
{
    public function __invoke(RegisterRequest $request)
    {
        $client = Client::create(['invitaion_code' => Str::random(6)] + $request->validated());

        $this->sendVerificationCode($client);

        return $this->success([
            'message' => 'Registered successfully and code has been sent',
            'client' => new ClientResource($client)
        ]);
    }

    private function sendVerificationCode($client)
    {
        VerificationCode::whereClientId($client->id)->create([
            'client_id'  =>  $client->id,                
            'code'       =>  1234,
        ]);
    }
}
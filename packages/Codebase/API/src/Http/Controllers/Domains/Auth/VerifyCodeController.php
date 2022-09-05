<?php

namespace Codebase\API\Http\Controllers\Domains\Auth;

use App\Domain\Client\Models\Client;
use App\Domain\Client\Models\VerificationCode;
use App\Domain\Client\Resources\ClientResource;
use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Http\Requests\VerifyCodeRequest;

class VerifyCodeController extends APIController
{
    public function __invoke(VerifyCodeRequest $request)
    {
        $validated = $request->validated();
        $client = Client::whereMobile($validated['mobile'])
                        ->whereMobileCountry($validated['mobile_country'])
                        ->first();

        $code = VerificationCode::whereCode($validated['otp'])
                                ->where('client_id',$client?->id)
                                ->first();
        if($code === null) return $this->error(__('Wrong OTP'));

        $code->delete();

        if(isset($validated['new_mobile'])){
            $client->update([
                'mobile' => $validated['new_mobile'],
                'mobile_country' => $validated['new_mobile_country']
            ]);
        }

        $token = $client->createToken('api');

        $client->forceFill(['token' => $token->plainTextToken]);

        return $this->success(new ClientResource($client));

    }
}
<?php

namespace Codebase\API\Http\Controllers\Domains\Auth;

use App\Domain\Client\Models\VerificationCode;
use App\Domain\Client\Resources\ClientResource;
use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Http\Requests\UpdateProfileRequest;

class UpdateProfileController extends APIController
{
    public function __invoke(UpdateProfileRequest $request)
    {
        $client = auth()->user();
        $validated = $request->all();
        if(isset($validated['mobile']) && $client->mobile != $validated['mobile']){
            return $this->sendVerificationCode();
        }
        $client->update($validated);
        if(isset($validated['image'])){
            $client->clearMediaCollection();
            $client->addMedia($validated['image'])->toMediaCollection();
        }
        return $this->success(new ClientResource($client->refresh()));
    }
    

    private function sendVerificationCode()
    {
        VerificationCode::whereClientId(auth()->id())->firstOrCreate([
            'client_id'  =>  auth()->id(),                
            'code'       =>  1234,
        ]);
        return $this->success(['verified' => false, 'message' => __('Verify phone first')]);
    }

}

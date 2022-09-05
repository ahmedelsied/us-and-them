<?php

namespace Codebase\API\Http\Controllers\Actions;

use App\Domain\Client\Models\Client;
use App\Domain\Client\Models\Referral;
use Codebase\API\Http\Controllers\APIController;
use Illuminate\Http\Request;

class StoreInvitaionCodeAction extends APIController
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate(['invitation_code' => 'required|string|exists:clients,invitation_code'],$request->all());
        $referrer = Client::where('invitation_code',$validated['invitation_code'])->firstOrFail();
        if(!Referral::where('referred_id',auth()->id())->exists()){
            Referral::create([
                'referrer_id'   =>  $referrer->id,
                'referred_id'   =>  auth()->id()
            ]);
    
            return $this->success('Valid Code Referred Successfully');
        }
        return $this->error('Already Referred');
    }
}
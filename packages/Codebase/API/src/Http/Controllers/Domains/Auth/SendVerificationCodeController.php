<?php

namespace Codebase\API\Http\Controllers\Domains\Auth;

use App\Domain\Client\Models\Client;
use App\Domain\Client\Models\VerificationCode;
use Carbon\Carbon;
use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Http\Requests\ValidateMobileRequest;

class SendVerificationCodeController extends APIController
{
    private $client;
    private $validated;

    public function __invoke(ValidateMobileRequest $request)
    {
        $this->validated = $request->validated();
        $this->setClient();

        if($this->client !== null){
            $verification = VerificationCode::whereClientId($this->client->id)->firstOrCreate([
                'client_id'  =>  $this->client->id,                
                'code'       =>  1234,
            ]);
    
            $lastSent  = Carbon::parse($verification->sent_at);
            // if($verification->sent_at=== null || Carbon::now()->diffInMinutes($lastSent) > 1){
                $verification->update([
                    'sent_at'   =>   now(),
                    'code'      =>   1234,
                ]);

                return $this->success(__('Code has been sent successfully'));
            // }

            return $this->error(__('Should wait 1 minute before send again'));
        }

        return $this->error(__('Wrong phone number'));
    }

    private function setClient()
    {
        $client = Client::where([
            'mobile'            => $this->validated['mobile'],
            'mobile_country'    =>  $this->validated['mobile_country']
        ])->first();

        $this->client = $client; 
    }
}
<?php

namespace Codebase\API\Http\Controllers\Domains\Auth;

use App\Domain\Client\Models\Client;
use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Http\Requests\ValidateMobileRequest;

class CheckMobileController extends APIController
{
    public function __invoke(ValidateMobileRequest $request)
    {
        $validated  = $request->validated();
        $isExist    = Client::whereMobile($validated['mobile'])
                            ->whereMobileCountry($validated['mobile_country'])
                            ->exists();
        return $this->success(['is_exist' => $isExist]);
    }
}
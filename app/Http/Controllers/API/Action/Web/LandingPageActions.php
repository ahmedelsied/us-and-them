<?php

namespace App\Http\Controllers\API\Action\Web;

use App\API\Http\Controllers\APIController;
use App\Domain\Contact\Models\Career;
use App\Domain\Contact\Models\ContactMessage;
use App\Http\Requests\API\Web\CareerRequest;
use App\Http\Requests\API\Web\ContactMessageRequest;
use Illuminate\Support\Arr;

class LandingPageActions extends APIController
{
    public function contact(ContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());
        return $this->executed();
    }
    
    public function career(CareerRequest $request)
    {
        $validated = $request->validated();
        $resume = Arr::pull($validated,'resume');
        $career = Career::create($validated);
        $career->addMedia($resume)->toMediaCollection();
        return $this->executed();
    }

}

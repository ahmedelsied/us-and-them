<?php

namespace Codebase\API\Http\Controllers\Domains\Clients;

use App\Domain\Client\Models\ClientFeedback;
use App\Domain\Client\Resources\ClientFeedbackResource;
use Codebase\API\Http\Controllers\APIController;
use Illuminate\Http\Request;

class AddFeedbackController extends APIController
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'stars' =>  'required|integer|min:1|max:5',
            'feedback'  =>  'required|string'
        ],$request->all());

        $feedback = ClientFeedback::create(['client_id' => auth()->id()] + $validated);

        return $this->success(new ClientFeedbackResource($feedback));
    }
}
<?php

namespace Codebase\API\Http\Controllers\Domains\Clients;

use App\Domain\Client\Models\Assessment;
use Codebase\API\Http\Controllers\APIController;
use Codebase\API\Resources\AssessmentResource;
use Illuminate\Http\Request;

class GetAssessmentController extends APIController
{
    public function __invoke(Request $request)
    {
        $assessments = Assessment::query();

        if($request->has('type')){
            $assessments->where('type',$request->type);
        }

        $assessments = $assessments->with('questions')->get();

        return $this->success(AssessmentResource::collection($assessments));
    }
}
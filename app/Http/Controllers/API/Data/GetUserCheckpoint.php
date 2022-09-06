<?php

namespace App\Http\Controllers\API\Data;

use App\API\Http\Controllers\APIController;
use Codebase\API\Support\Services\APIResponse\ApiResponse;

class GetUserCheckpoint extends APIController
{
    public function __invoke()       
    {
        $checkpoint = auth()->user()->information?->checkpoint ?? 'CHECKPOINT_APPLICATION';
        return ApiResponse::success($checkpoint);
    }
    
}

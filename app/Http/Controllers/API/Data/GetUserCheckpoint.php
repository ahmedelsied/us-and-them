<?php

namespace App\Http\Controllers\API\Data;

use App\API\Http\Controllers\APIController;

class GetUserCheckpoint extends APIController
{
    public function __invoke()       
    {
        $checkpoint = auth()->user()->information?->checkpoint ?? 'CHECKPOINT_APPLICATION';
        return $this->success($checkpoint);
    }
    
}

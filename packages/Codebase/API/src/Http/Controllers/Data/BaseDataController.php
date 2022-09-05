<?php

namespace Codebase\API\Http\Controllers\Data;

use Codebase\API\Http\Controllers\APIController;

class BaseDataController extends APIController
{
    public function __invoke()
    {
        return $this->executed();
    }
}
<?php

namespace Codebase\API\Http\Controllers\Actions;

use Codebase\API\Http\Controllers\APIController;

class BaseActionController extends APIController
{
    public function __invoke()
    {
        return $this->executed();
    }
}
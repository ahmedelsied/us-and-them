<?php

namespace Codebase\API\Http\Controllers\Data\Screens;

use Codebase\API\Http\Controllers\APIController;

class BaseScreenController extends APIController
{
    public function __invoke()
    {
        return $this->executed();
    }
}
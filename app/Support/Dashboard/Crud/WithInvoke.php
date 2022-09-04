<?php

namespace App\Support\Dashboard\Crud;

trait WithInvoke
{
    public function __invoke()
    {
        $validated = $this->validationAction();
        $action = $this->invokeAction($validated);

        return $action ?? $this->successfulRequest();
    }

    protected function invokeAction(array $validated)
    {
        ($this->model)::create($validated);

        return null;
    }
}

<?php

namespace App\Support\Dashboard\Crud;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

trait WithStore
{

    protected function storeAction(array $validated)
    {
        $files = [];
        foreach ($this->files as $key => $value) {
            $files[$key] = Arr::pull($validated, $key);
        }

        $model = ($this->model)::create($validated);

        foreach ($this->files as $key => $collection) {
            $file = $files[$key];
            if ($file instanceof UploadedFile) {
                $model->addMedia($file)->toMediaCollection($collection);
            }
        }

        return null;
    }

    public function store()
    {
        $validated = $this->validationAction();

        $action = $this->storeAction($validated);

        return $action ?? $this->successfulRequest();
    }
}

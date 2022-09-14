<?php

namespace App\Support\Dashboard\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

trait WithUpdate
{
    
    protected function updateAction(array $validated, Model $model)
    {
        $files = [];
        foreach ($this->files as $key => $value) {
            $files[$key] = Arr::pull($validated, $key);
        }

        $model->update($validated);

        foreach ($this->files as $key => $collection) {
            $file = $files[$key];
            if ($file instanceof UploadedFile) {
                $model->clearMediaCollection($collection);
                $model->addMedia($file)->toMediaCollection($collection);
            }
        }

        return null;
    }
    public function update($id)
    {
        $model = ($this->model)::findOrFail($id);
        $validated = $this->validationAction();

        $action = $this->updateAction($validated, $model);

        return $action ?? $this->successfulRequest();
    }
}

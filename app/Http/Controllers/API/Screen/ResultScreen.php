<?php

namespace App\Http\Controllers\API\Screen;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Enums\Checkpoints;
use App\Support\Dashboard\Crud\WithInvoke;

class ResultScreen extends APIController
{
    public function __invoke()
    {
        $user = auth()->user();
        if(!$this->checkpoint($user)){
            return $this->error([
                'message'       =>  __('Wrong checkpoint'),
                'checkpoint'    =>  $user->checkpoint
            ]);
        }
        $this->updateCheckpoint($user);
        $age = $user->information?->birthdate?->age;
        $mentalAge = $user->information?->mental_age;
        return $this->success([
            'name'          =>  $user->name,
            'age'           =>  $age > 1 ? $age . ' ' . __('Years') : $age . ' ' . __('Year'),
            'mental_age'    =>  $mentalAge > 1 ? $mentalAge . ' ' .__('Years') : $mentalAge . ' ' .__('Year')
        ]);
    }

    private function checkpoint($user)
    {
        return $user->checkpoint == Checkpoints::result()->value;
    }

    private function updateCheckpoint($user)
    {
        $user->information?->update([
            'checkpoint'    =>  Checkpoints::treatment()->value
        ]);
    }
}


<?php

namespace App\Http\Controllers\API\Action\Assessment;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Enums\Checkpoints;
use App\Domain\Core\Models\Administration\UserInformation;
use App\Http\Resources\API\Assessment\AgeActivityResource;
use App\Support\Dashboard\Crud\WithInvoke;
use Illuminate\Support\Carbon;

class CompleteApplicationAction extends APIController
{
    use WithInvoke;

    protected function invokeAction(array $validated)
    {
        if(!UserInformation::whereUserId(auth()->id())->exists()){
            $age = Carbon::parse($validated['birthdate'])->age;
            $mentalAge = $validated['is_patient'] ? ($age-2) : ($age-1);
            $user = auth()->user();
            
            UserInformation::create([
                'user_id'               =>  $user->id,
                'mental_age'            =>  $mentalAge,
                'current_age_activity'  =>  $mentalAge,
                'checkpoint'            =>  Checkpoints::test()->value,
            ] + $validated);
            
            $user->refresh();

            return $this->success(new AgeActivityResource($user->getAgeActivity()));

        }

        return $this->error(__('Wrong Checkpoint'));
    }

    protected function rules()
    {
        return [
            'birthdate'             =>  'required|date|date_format:Y-m-d',
            'neurologists_disease'  =>  'nullable|string',
            'estimated_mental_age'  =>  'nullable|string',
            'is_patient'            =>  'required|boolean'
        ];
    }

}

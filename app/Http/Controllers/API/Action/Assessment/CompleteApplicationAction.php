<?php

namespace App\Http\Controllers\API\Action\Assessment;

use App\API\Http\Controllers\APIController;
use App\Domain\Core\Enums\Checkpoints;
use App\Domain\Core\Models\Administration\UserInformation;
use App\Http\Resources\API\Assessment\AgeActivityResource;
use App\Support\Dashboard\Crud\WithInvoke;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class CompleteApplicationAction extends APIController
{
    use WithInvoke;

    protected function invokeAction(array $validated)
    {
        if(!UserInformation::whereUserId(auth()->id())->exists()){
            $age = Carbon::parse($validated['birthdate'])->age;
            $mentalAge = $this->setMentalAge($age,$validated['is_patient']);
            
            $user = auth()->user();
            $user->update(['name' => Arr::pull($validated,'name')]);
            $user->information()->create((
                            [
                                'mental_age'            =>  $mentalAge,
                                'current_age_activity'  =>  $mentalAge,
                                'checkpoint'            =>  Checkpoints::test()->value,
                            ] + 
                            $validated ));
            
            $user->refresh();

            return $this->success(new AgeActivityResource($user->getAgeActivity()));

        }

        return $this->error(__('Wrong Checkpoint'));
    }

    private function setMentalAge($age,$is_patient)
    {
        $mentalAge = 0;
        if($age > 1){
            $mentalAge = $is_patient ? ($age-2) : ($age-1);
        }

        return $mentalAge;
    }

    protected function rules()
    {
        return [
            'name'                  =>  'required|string|max:100',
            'birthdate'             =>  'required|date|date_format:Y-m-d',
            'neurologists_disease'  =>  'nullable|string',
            'estimated_mental_age'  =>  'nullable|string',
            'is_patient'            =>  'required|boolean'
        ];
    }

}

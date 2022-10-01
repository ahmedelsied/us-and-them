<?php

namespace App\Http\Controllers\API\Screen;

use App\API\Http\Controllers\APIController;
use App\Domain\Assessment\Models\AgeActivity;
use App\Domain\Core\Enums\Phases;
use App\Http\Resources\API\Assessment\AgeActivityResource;
use App\Support\Dashboard\Crud\WithInvoke;

class GetTreatmentStagesFields extends APIController
{
    use WithInvoke;
    
    protected function invokeAction(array $validated)
    {
        $stageFields = $this->getStageFields($validated);
        return $this->success(new AgeActivityResource($stageFields));
    }

    private function getStageFields($validated)
    {
        $user = auth()->user();
        $ceilFieldId = $user->information?->ceil_field_id;
        return AgeActivity::with([
                                    'fields' => fn($q) => $q->withCount([
                                    'activities',
                                    'user_answers' => fn($query) => $query->wherePhase(Phases::treatment()->value)
                                                                          ->whereUserId($user->id)
                                                                          ])
                                                            ->where('id','>=',$ceilFieldId)])
                                                            ->find($validated['age_activity_id']);
    }

    protected function rules()
    {
        return [
            'age_activity_id'   =>  'required|exists:age_activities,id'
        ];
    }
}

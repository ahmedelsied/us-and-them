<?php

namespace App\Http\Middleware\API\Assessment;

use App\Domain\Assessment\Models\Activity;
use App\Domain\Assessment\Models\Field;
use App\Domain\Core\Enums\Checkpoints;
use Closure;
use Codebase\API\Support\Services\APIResponse\ApiResponse;
use Illuminate\Http\Request;

class ActivityLogAuthorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$this->allowedToAnswerActivity()){
            return ApiResponse::error('Authorization Error Or Wrong Checkpoint',400,['checkpoint' => auth()->user()->information?->checkpoint]);
        }
        return $next($request);
    }

    private function allowedToAnswerActivity()
    {
        $userAgeActivity = auth()->user()->information?->current_age_activity;
        $field = Field::findOrFail(request('field_id'));
        $activity = Activity::findOrFail(request('activity_id'));

        return (
            auth()->user()->information?->checkpoint == Checkpoints::test()->value &&
            ($userAgeActivity == $field->age_activity_id || ($field->age_activity_id == 1 && $userAgeActivity <= 1)) &&
            $activity->field_id == $field->id
        );
    }
}

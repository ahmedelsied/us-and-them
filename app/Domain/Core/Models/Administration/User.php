<?php

namespace App\Domain\Core\Models\Administration;

use App\Domain\Assessment\Models\AgeActivity;
use App\Domain\Assessment\Models\UserActivityAnswer;
use App\Domain\Core\Enums\Checkpoints;
use App\Domain\Core\Enums\Phases;
use App\Support\Concerns\HasFactory;
use App\Support\Traits\HasPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasPassword;
    use InteractsWithMedia;

    protected $fillable = ['name', 'email', 'phone', 'password','uid','platform'];

    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['checkpoint'];

    protected $with = ['media'];

    public function getAvatarAttribute()
    {
        return $this->getFirstMediaUrl();
    }

    public function information()
    {
        return $this->hasOne(UserInformation::class);
    }

    public function getCheckpointAttribute()
    {
        return !empty($this->information?->checkpoint) ? $this->information?->checkpoint : Checkpoints::application()->value;
    }

    
    public function getAgeActivity()
    {
        if($this->information?->checkpoint == Checkpoints::test()->value){

            $currentAgeActivity = $this->information?->current_age_activity;
            $index = !is_null($currentAgeActivity) ? $currentAgeActivity :  $this->information?->mental_age;
            $index = $index == 0 ? $index : ($index -1);
            return AgeActivity::whereIndex($index)
                              ->with(['fields' => fn($q) => $q->withCount(['activities','user_answers' => fn($q) => $q->whereUserId($this->id)])])
                              ->first();

        }

        return null;
    }

    public function getStageFields($ageActivityId)
    {
        $ceilFieldId = $this->information?->ceil_field_id;
        return AgeActivity::with([
                                    'fields' => fn($q) => $q->withCount([
                                                                            'activities',
                                                                            'user_answers' => fn($query) => $query->wherePhase(Phases::treatment()->value)
                                                                                                                  ->whereUserId($this->id)
                                                                          ])
                                                            ->where('id','>=',$ceilFieldId)])
                                                            ->find($ageActivityId);
    }

    public function answers_log()
    {
        return $this->hasMany(UserActivityAnswer::class);
    }

    public function updateCheckpoint($checkpoint)
    {
        $this->information()->update([
            'checkpoint'    =>  $checkpoint
        ]);
    }
}

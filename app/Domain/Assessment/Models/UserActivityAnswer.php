<?php

namespace App\Domain\Assessment\Models;

use App\Domain\Assessment\Models\Activity;
use App\Domain\Assessment\Models\AgeActivity;
use App\Domain\Assessment\Models\Field;
use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'user_activity_answers_log';

    protected $casts = [
        'passed' => 'boolean'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
    
    public function age_activity()
    {
        return $this->belongsTo(AgeActivity::class);
    }
    
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

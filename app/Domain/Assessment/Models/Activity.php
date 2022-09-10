<?php

namespace App\Domain\Assessment\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Activity extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,HasTranslations,InteractsWithMedia;

    protected $guarded = [];
    protected $with = ['media'];
    protected $translatable = [
        'title',
        'description',
        'activity_one_title',
        'activity_two_title',
        'activity_one_description',
        'activity_two_description'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function user_answer()
    {
        return $this->hasOne(UserActivityAnswer::class,'activity_id');
    }
}

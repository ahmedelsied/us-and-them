<?php

namespace App\Domain\Assessment\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Field extends Model implements HasMedia
{
    use HasFactory,HasTranslations,InteractsWithMedia,SoftDeletes;

    protected $guarded = [];
    protected $translatable = ['name','description'];

    public function age_activity()
    {
        return $this->belongsTo(AgeActivity::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}

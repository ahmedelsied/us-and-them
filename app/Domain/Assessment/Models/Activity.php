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
    protected $translatable = ['title','description'];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}

<?php

namespace App\Domain\Assessment\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AgeActivity extends Model
{
    use HasFactory,HasTranslations,SoftDeletes;

    protected $guarded = [];
    protected $translatable = ['title'];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}

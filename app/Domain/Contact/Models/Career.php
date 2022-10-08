<?php

namespace App\Domain\Contact\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Career extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $guarded = [];
}

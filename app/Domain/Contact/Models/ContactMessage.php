<?php

namespace App\Domain\Contact\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $guarded = [];
}

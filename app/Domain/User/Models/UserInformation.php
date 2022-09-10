<?php

namespace App\Domain\Core\Models\Administration;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_informations';
    protected $guarded = [];
    protected $dates = ['birthdate'];
    protected $casts = [
        'is_patient'    =>  'boolean'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

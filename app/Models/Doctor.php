<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    protected $fillable = ['user_id','specialty_id',
    'license_number', 'bio'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function specialty()
    {
        $this->belongsTo(Specialty::class);
    }
}

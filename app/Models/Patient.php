<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;

class Patient extends Model
{
    use SoftDeletes;
    protected $fillable = ['code', 'full_name', 'gender', 
    'date_of_birth', 'phone', 'email', 'address'];

    protected $casts = ['date_of_birth' => 'date'];
    public function appointments(): HasMany
    {
        return $this->hasMany(Appoinment::class);
    }

}

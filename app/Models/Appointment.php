<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;
    
    protected $fillable = ['patient_id', 'doctor_id',
    'scheduled_at', 'status', 'reason'];

    protected $casts = ['scheduled_at'=> 'datetime'];
    public function patient()
    {
        return $this->belongsTo(Patient::class);

    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function examinations()
    {
        return $this->belongsTo(Examination::class);
    }
}

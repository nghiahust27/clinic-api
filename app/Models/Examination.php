<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = ['appointment_id', 'doctor_id', 'patient_id',
    'diagnosis', 'note', 'examinated_at'];

    protected $casts = ['examinated_at' => 'datetime'];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}

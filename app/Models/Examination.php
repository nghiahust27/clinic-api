<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = ['appointment_id', 'doctor_id', 'patient_id',
    'diagnosis', 'note', 'examinated_at', 'examination_fee'];

    protected $casts = ['examinated_at' => 'datetime',
    'examination_fee' => 'decimal:2'];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}

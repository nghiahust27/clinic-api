<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['examination_id',
    'doctor_id', 'note'];


    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function items()
    {
        return $this->hasMany(PrescriptionItem::class);
    }

}

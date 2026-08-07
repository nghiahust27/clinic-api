<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\FuncCall;

class AppointmentService
{
    public function getAll(array $filters, int $perPage=10)
    {
        return Appointment::query()->with(['patient', 'doctor.user'])
        ->when($filters['doctor_id']??null,
        function($q, $doctorId){
            $q->where('doctor_id', $doctorId);
        })->when($filters['data'] ?? null,
        function($q, $date){
            $q->whereData('scheduled_at', $date);
        })->when($filters['status'] ?? null,
        function ($q, $status) {
            $q->where('status', $status);
        })->latest()->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Appointment::with('doctor', 'patient')->findOrFail($id);
    }
    public function create(array $data)
    {
        $data['status'] = 'scheduled';
        return Appointment::create($data);
    }
    public function update(Appointment $appointment, array $data)
    {
        if($appointment->status !=='scheduled')
        {
            abort(422, 'Only scheduled appointment can be updated');
        }
        $appointment->update($data);
        return $appointment->fresh();
    }

    public function updateStatus(Appointment $appointment, string $status)
    {
        $appointment->update(['status'=>$status]);
        return $appointment;
    }

}

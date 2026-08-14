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
    private array $statusTransitions = [
        'scheduled' => ['confirmed', 'cancelled'],
        'confirmed' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => []
    ];

    public function getAll(array $filters, int $perPage=10)
    {
        return Appointment::query()->with(['patient', 'doctor.user'])
        ->when($filters['full_name'] ?? null, function ($q, $fullName) {
            $q->whereHas('patient', function ($query) use ($fullName) {
                $query->where('full_name', 'ILIKE', "%{$fullName}%");
            });
        })

        ->when($filters['date'] ?? null,
        function($q, $date){
            $q->whereDate('scheduled_at', $date);
        })
        
        ->when($filters['status'] ?? null,
        function ($q, $status) {
            $q->where('status', $status);
        })->latest()->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Appointment::with('doctor', 'patient')->findOrFail($id);
    }

    public function checkScheduleConflict(int $doctorId, 
    string $scheduledAt, ?int $ignoreAppointmentId = null): void
    {
        $exists = Appointment::where('doctor_id', $doctorId)
        ->where('scheduled_at', $scheduledAt)
        ->where('status', '!=', 'cancelled')
        ->when($ignoreAppointmentId, function($query) use(
            $ignoreAppointmentId
        ){
            $query->where('id', '!=', $ignoreAppointmentId);
        })->exists();

        if($exists)
        {
            throw ValidationException::withMessages([
                'scheduled_at'=>['Doctor already has an appointment at this time']
            ]);
        }
    }

    public function create(array $data)
    {
        
        $this->checkScheduleConflict($data['doctor_id'],
         $data['scheduled_at']);
        $data['status'] = 'scheduled';
        return Appointment::create($data); 
    }
    public function update(Appointment $appointment, array $data)
    {

        if($appointment->status !=='scheduled')
        {
            abort(422, 'Only scheduled appointment can be updated');
        }
        $doctorId = $data['doctor_id'] ?? $appointment->doctor_id;
        $scheduledAt = $data['scheduled_at'] ?? $appointment->scheduled_at;

        $this->checkScheduleConflict($doctorId, $scheduledAt, $appointment->id);
        $appointment->update($data);
        return $appointment->fresh();
    }

    public function updateStatus(Appointment $appointment, string $status)
    {
        $currentStatus = $appointment->status;
        if(!isset($this->statusTrainstions[$currentStatus])  || 
        !in_array($status, $this->statusTransitions[$currentStatus]))
        {
            abort(422, "cannot change status from {$currentStatus} to
            {$status}");
        }
        $appointment->update(['status'=>$status]);
        return $appointment;
    }

}

<?php

namespace App\Services;

use App\Events\AppointmentStatusUpdated;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
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
        $newStart = Carbon::parse($scheduledAt);
        $newEnd = $newStart->copy()->addMinutes(30);

        $query = Appointment::query()
            ->where('doctor_id', $doctorId)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->where(function($query) use ($newStart, $newEnd){
                $query->where('scheduled_at', '<', $newEnd)
                ->whereRaw("scheduled_at + INTERVAL '30 minutes'> ?",
                [$newStart]);
            });
        
        if($ignoreAppointmentId)
        {
            $query->where('id', '!=', $ignoreAppointmentId);
        }
        if($query->exists())
        {
            throw ValidationException::withMessages([
                'scheduled_at'=> ['The doctor already has an appointment during this time']
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

    public function updateStatus(Appointment $appointment, 
    string $status)
    {
        $oldStatus = $appointment->status;

        if (
            !isset($this->statusTransitions[$oldStatus]) ||
            !in_array($status, $this->statusTransitions[$oldStatus])
        ) {
            abort(
                422,
                "cannot change status from {$oldStatus} to {$status}"
            );
        }

        $appointment->update([
            'status' => $status,
        ]);

        event(new AppointmentStatusUpdated(
            $appointment,
            $oldStatus,
            $status
        ));

        return $appointment;
    }

}

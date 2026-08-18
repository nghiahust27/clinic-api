<?php

namespace App\Services;

use App\Events\ExaminationCreated;
use App\Events\ExaminationUpdated;
use App\Models\Appointment;
use App\Models\Examination;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ExaminationService
{
    public function getAll(array $filters, int $perPage = 5)
    {
        return Examination::query()->with(['appointment.patient',
         'appointment.doctor.user'])
        ->when($filters['full_name'] ?? null, function ($q, $fullName) {
            $q->whereHas('appointment.patient', function ($query) use ($fullName) {
                $query->where('full_name', 'ILIKE', "%{$fullName}%");
            });
        })

        ->when($filters['date'] ?? null,
        function($q, $date){
            $q->whereDate('examinated_at', $date);
        })->latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use($data){
            $appointment = Appointment::with('patient')
            ->findOrFail($data['appointment_id']);

            // Examination only created before appointment confirmed

            if($appointment->status === 'completed')
            {
                throw ValidationException::withMessages([
                    'appointment_id'=>['Cannot create examination for 
                    a completed appointment.']
                ]);
            }
            if($appointment->status === 'cancelled')
            {
                throw ValidationException::withMessages([
                    'appointment_id'=>['Cannot create examination for 
                    a cancelled appointment.']
                ]);
            }
            if($appointment->status === 'scheduled')
            {
                throw ValidationException::withMessages([
                    'appointment_id'=>['Cannot create examination for 
                    a scheduled appointment, confirm it first']
                ]);
            }


            $examination=  Examination::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient_id,
                'doctor_id' => $appointment->doctor_id,
                'diagnosis' => $data['diagnosis'] ?? null,
                 'examination_fee' => $data['examination_fee'],
                'note' => $data['note'] ?? null,
                'examinated_at'=> now()
            ]);
            $appointment->update([
                'status'=>'completed'
            ]);
            event(new ExaminationCreated($examination));
            return $examination;
        });
    }
    public function findById(int $id)
    {
        return Examination::with('appointment')
        ->findOrFail($id);
    }

    public function update(Examination $examination, array $data)
    {
        $oldDiagnosis = $examination->diagnosis;
        $oldNote = $examination->note;

        $examination->update($data);
        $examination->fresh();
        $newDiagnosis = $examination->diagnosis;
        $newNote = $examination->note;

        event(new ExaminationUpdated($examination, $oldDiagnosis, 
        $newDiagnosis, $oldNote, $newNote));
        return $examination;
    }

}
<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Examination\StoreExaminationRequest;
use App\Http\Requests\Examination\UpdateExaminationRequest;
use App\Models\Appointment;
use App\Models\Examination;
use App\Services\ExaminationService;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function __construct(
        private ExaminationService $service
    ){        
    }
    public function index(Request $request)
    {
        $examinations = $this->service->getAll($request->only([
            'full_name', 'date'
        ]));
        return view('examinations.index', compact('examinations'));

    }

    public function show(Examination $examination)
    {
        $examination->load([
            'appointment', 'appointment.patient',
             'appointment.doctor.user', 'appointment.doctor.specialty'
        ]);
        return view('examinations.show', compact('examination'));
    }

    public function create(Appointment $appointment)
    {
        $appointment->load([
            'patient', 'doctor.user', 'doctor.specialty'
        ]);
        return view('appointments.createexamination',
        compact('appointment'));
    }
    public function store(StoreExaminationRequest $request,
    Appointment $appointment)
    {
        $data = $request->validated();
        $data['appointment_id'] = $appointment->id;
        $this->service->create($data);
        return redirect()->route('appointments.show', [
            'appointment' => $appointment->id
        ])->with('success',
        'Examination created successfully');
    }

    public function edit(Examination $examination)
    {
        $examination ->load([
            'appointment.patient',
            'appointment.doctor'
        ]);
        return view('examinations.edit', compact('examination'));
    }

     public function update(UpdateExaminationRequest $request,
      Examination $examination)
    {
        $this->service->update($examination,$request->validated());

        return redirect()->route('examinations.show', $examination)
        ->with('success', 'Examination updated successfully');
    }
}

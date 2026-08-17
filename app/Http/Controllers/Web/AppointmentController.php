<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentStatusRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class AppointmentController extends Controller
{

    public function __construct(
        private AppointmentService $service
    ){        
    }
    public function index(Request $request)
    {
        $appointments = $this->service->getAll($request->only([
            'full_name', 'date', 'status'
        ]));

        return view('appointments.index', compact('appointments'));

       
    }

    public function show(Appointment $appointment)
    {
        $appointment ->load([
            'patient', 'doctor.user', 'doctor.specialty'
        ]);

        return view('appointments.show', compact('appointment'));

    }
    
    public function create(Patient $patient)
    {
        $doctors = Doctor::with([
            'user',
            'specialty'
        ])->get();

        return view(
            'patients.createappointment',
            compact('patient', 'doctors')
        );
        
    }

    public function store(
        StoreAppointmentRequest $request,
        Patient $patient
    ) {
    
        $data = $request->validated();

        $data['patient_id'] = $patient->id;
        

        $this->service->create($data);
    
        return redirect()
            ->route('patients.show', [
                'patient' => $patient->id
            ])
            ->with(
                'success',
                'Appointment created successfully.'
            );
    }
    public function edit(Appointment $appointment)
    {
        $appointment->load([
            'patient', 'doctor.user', 'doctor.specialty'
        ]);
        $doctors = Doctor::with(['user', 'specialty'])->get();

        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    public function update(UpdateAppointmentRequest $request, 
    Appointment $appointment)
    {
        $this->service->update($appointment, $request->validated());
        return redirect()->route('appointments.show', $appointment)
        ->with('success', 'Appointment updated successfully');
    }

    public function updateStatus(UpdateAppointmentStatusRequest $request,
    Appointment $appointment)
    {   
        $this->service->updateStatus($appointment,
         $request->validated('status'));
        return redirect()->route('appointments.show', $appointment)
        ->with('success', 'Appointment status updated successfully');
    }
    public function paypalSuccess(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'PayPal payment approved.',
            'token' => $request->query('token'),
            'payer_id' => $request->query('PayerID'),
        ]);
    }
    public function paypalCancel()
    {
        return response()->json([
            'success' => false,
            'message' => 'PayPal payment cancelled.',
        ]);
    }

}

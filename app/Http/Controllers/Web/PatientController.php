<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Models\Doctor;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(
        private PatientService $patientService
    ) {
    }
    public function index(Request $request)
    {
        $patients = $this->patientService->getAll($request->input('q'));

        return view('patients.index', compact('patients'));
    }

    public function create() {
        return view('patients.create');
    }

    public function store(StorePatientRequest $request)
    {
        $this->patientService->create(
            $request->validated()
        );
        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $patient->load([
            'appointments.doctor.user',
            'appointments.doctor.specialty',
            'appointments.examination'
        ]);

        return view(
            'patients.show',
            compact('patient')
        );
    }
    public function edit(Patient $patient)
    {
        $patient = $this->patientService->findById(
            $patient->id
        );

        return view(
            'patients.edit',
            compact('patient')
        );
    }

    public function update(
        UpdatePatientRequest $request,
        Patient $patient
    ) {
        $this->patientService->update(
            $patient,
            $request->validated()
        );

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $this->patientService->delete($patient);
        return redirect()->route('patients.index')
         ->with('success', 'Patient moved to trash successfully.');
    }
    public function restore(int $id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);
        $patient->restore();
        return redirect()->route('patients.index')
         ->with('success', 'Patient restored successfully.');
    }
    public function forceDelete(int $id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);
        $patient->forceDelete();
        return redirect()->route('patients.index')
         ->with('success', 'Patient deleted successfully.');

    }

    public function trash()
    {
        $patients = $this ->patientService->getTrashed();
        return view('patients.trash', compact('patients'));
    }   
        
}

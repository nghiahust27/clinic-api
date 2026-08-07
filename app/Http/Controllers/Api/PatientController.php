<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(
        private PatientService $patientService 
    ){
    }

    public function index(Request $request)
    {
        return PatientResource::collection(
            $this->patientService->getAll($request->q)
        );
    }
    public function show(Patient $patient)
    {
        return new PatientResource($patient);
    }
    public function store(StorePatientRequest $request)
    {
        $patient = $this->patientService->create(
            $request->validated()
        );
        return new PatientResource($patient);
    }
    public function update(UpdatePatientRequest $request)
    {
        $patient = $this->patientService->update(
            $patient, $request->validated()
        );
        return new PatientResource($patient);
    }

    public function destroy(Patient $patient)
    {
        $this->patientService->delete($patient);
        return response()->json([
            'message'=>'Patient deleted successfully'
        ]);
    }

}

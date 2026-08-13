<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use App\Services\DoctorService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct(
        private DoctorService $doctorService
    ) {
    }
    public function index()
    {
        $doctors = $this->doctorService->getAll();

        return view('doctors.index', compact('doctors'));
    }

    public function create() {
        $users = User::where('role_id', 3)
        ->whereDoesntHave('doctor')
        ->where('is_active', true)
        ->get();

        $specialties = Specialty::orderBy('name')->get();

        return view('doctors.create', compact('users', 'specialties'));
    }

    public function store(StoreDoctorRequest $request)
    {
        $this->doctorService->create(
            $request->validated()
        );
        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        $doctor = $this->doctorService->findById(
            $doctor->id
        );

        return view('doctors.show', compact('doctor'));
    }
    public function edit(Doctor $doctor)
    {
        $doctor = $this->doctorService->findById(
            $doctor->id
        );

        return view(
            'doctors.edit',
            compact('doctor')
        );
    }

    public function update(
        UpdateDoctorRequest $request,
        Doctor $doctor
    ) {
        $this->doctorService->update(
            $doctor,
            $request->validated()
        );

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        $this->doctorService->delete($doctor);
        return redirect()->route('doctors.index')
         ->with('success', 'Doctor deleted successfully.');
    }
}

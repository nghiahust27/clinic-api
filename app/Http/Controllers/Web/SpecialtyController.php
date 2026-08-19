<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specialty\StoreSpecialtyRequest;
use App\Http\Requests\Specialty\UpdateSpecialtyRequest;
use App\Models\Specialty;
use App\Services\SpecialtyService;

use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function __construct(
        private SpecialtyService $service
    )
    {
    }
    public function index()
    {
        $specialties = $this->service->getAll();

        return view('specialties.index', compact('specialties'));
    }
    public function show(Specialty $specialty)
    {
       
        $specialty->load(['doctors.user']); 

        return view('specialties.show', compact('specialty'));
    }
    public function create() {
        return view('specialties.create');
    }
    public function store(StoreSpecialtyRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('specialties.index')
        ->with('success', 'Specialty created successfully.');
    }
    public function edit(Specialty $specialty)
    {

        return view('specialties.edit', compact('specialty'));
    }
    public function update(UpdateSpecialtyRequest $request,
    Specialty $specialty)
    {
        $this->service->update($specialty,
        $request->validated());
        
        return redirect()
            ->route('specialties.index')
            ->with('success', 'Specialty updated successfully.');
    }
    public function destroy(Specialty $specialty)
    {
        $this->service->delete($specialty);
        
        return redirect()
            ->route('specialties.index')
            ->with(
                'success',
                'Specialty deactive successfully.'
            );
    }
}

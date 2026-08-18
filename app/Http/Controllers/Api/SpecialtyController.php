<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specialty\StoreSpecialtyRequest;
use App\Http\Requests\Specialty\UpdateSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Http\Traits\ApiResponse;
use App\Models\Specialty;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    use ApiResponse;
    public function __construct(
        protected SpecialtyService $specialtyService
    ){
    }
    public function index()
    {
        $specialties = SpecialtyResource::collection(
            $this->specialtyService->getAll()
        );
        return $this->paginatedResponse(
            $specialties, 'Specialties retrieved successfully'
        );
    }
    public function show(Specialty $specialty)
    {
        $specialty = $this->specialtyService->findById(
            $specialty->id);

        return $this->successResponse(
            new SpecialtyResource($specialty),
            'Specialty retrieved successfully'
        );
    }

    public function store(StoreSpecialtyRequest $request)
    {
        $specialty = $this->specialtyService->create(
            $request->validated()
        );
        return $this->successResponse(
            new SpecialtyResource($specialty),
            'Specialty created successfully'
        , 201);
    }
    public function update(UpdateSpecialtyRequest $request,
    Specialty $specialty)
    {
        $specialty = $this->specialtyService->update(
            $specialty, $request->validated()
        );
        return $this->successResponse(
            new SpecialtyResource($specialty),
            'Specialty updated successfully'
        );
    }
    public function destroy(Specialty $specialty)
    {
        $this->specialtyService->delete($specialty);
        return $this->successResponse(
            null,
            'Specialty deleted successfully'
        );
    }

}

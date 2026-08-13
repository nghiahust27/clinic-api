<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Http\Requests\Prescription\AddPrescriptionItemRequest;
use App\Http\Requests\Prescription\StorePrescriptionRequest;
use App\Http\Requests\Prescription\UpdatePrescriptionItemRequest;
use App\Http\Resources\PrescriptionResource;
use App\Http\Traits\ApiResponse;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Services\PrescriptionService;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    use ApiResponse;

    public function __construct(
        private PrescriptionService $service) {
    }
    public function store(StorePrescriptionRequest $request)
    {
        $prescription = $this->service->create($request->validated());

        return response()->json([
            'success' => true,
            'message'=> 'Prescription created successfully',
            'data'=> new PrescriptionResource($prescription)
        ], 201);
    }

    public function show(Prescription $prescription)
    {
        $prescription = $this->service->findById($prescription->id);
        return response()->json([
            'success' => true,
            'message'=> 'Prescription retrieved successfully',
            'data'=> new PrescriptionResource($prescription)
        ], 201);
    }

    public function update(UpdateAppointmentRequest $request,
    Prescription $prescription)
    {
        $prescription = $this->service->update($prescription,
        $request->validated());

        return response()->json([
            'success' => true,
            'message'=> 'Prescription updated successfully',
            'data'=> new PrescriptionResource($prescription)
        ], 201);
    }

    public function addItem(AddPrescriptionItemRequest $request,
    Prescription $prescription)
    {
        $item = $this->service->addItem($prescription,
        $request->validated());
        return response()->json([
            'success' => true,
            'message'=> 'Medicine added to prescription successfully',
            'data'=> new PrescriptionResource($item)
        ], 201);
    }

    public function updateItem(UpdatePrescriptionItemRequest $request,
    Prescription $prescription, PrescriptionItem $item)
    {
        $item = $this->service->updateItem($prescription,
        $item, $request->validated());

        return response()->json([
            'success' => true,
            'message'=> 'Prescription item updated successfully',
            'data'=> new PrescriptionResource($prescription)
        ], 201);
    }

    public function removeItem(Prescription $prescription,
    PrescriptionItem $item)
    {
        $this-> service ->removeItem($prescription, $item);

        return response()->json([
            'success' => true,
            'message'=> 'Prescription item remove successfully',
        ]);
    }
}

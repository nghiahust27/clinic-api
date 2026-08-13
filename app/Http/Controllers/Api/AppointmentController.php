<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentStatusRequest;
use App\Http\Resources\AppointmentResource;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    use ApiResponse;
    public function __construct(
        private AppointmentService $service
    ){        
    }
    public function index(Request $request)
    {
        $appointments = AppointmentResource::collection(
            $this->service->getAll($request->only([
                'doctor_id', 'date', 'status'
            ]))
        );
        return $this->paginatedResponse($appointments, 
        'Appointments retrieved successfully');
    }
    public function show(Appointment $appointment)
    {
        $appointment = $this->service->findById($appointment->id);
        return response()->json([
            'success'=>true,
            'message'=>'appointment retrieved successfully',
            'data'=> new AppointmentResource($appointment)]
        ); 

    }

    public function store(StoreAppointmentRequest $request) {
        $appointment = $this->service->create($request->validated());
        return response()->json([
            'success'=>true,
            'message'=>'Appointment created successfully',
            'data'=> new AppointmentResource($appointment)
        ]);
    }

    public function update(UpdateAppointmentRequest $request,
    Appointment $appointment)
    {
        $appointment = $this->service
        ->update($appointment, $request->validated());

         return response()->json([
            'success'=>true,
            'message'=>'Appointment updated successfully',
            'data'=> new AppointmentResource($appointment)
        ]);
    }   
    public function updateStatus(UpdateAppointmentStatusRequest $request,
    Appointment $appointment)
    {
        $appointment = $this->service->updateStatus(
            $appointment, $request->status
        );
        return response()->json([
            'success'=>true,
            'message'=>'Appointment status updated successfully',
            'data'=> new AppointmentResource($appointment)
        ]);
    }
}

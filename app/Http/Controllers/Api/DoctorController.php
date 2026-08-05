<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Services\DoctorService;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    public function __construct(
        protected DoctorService $doctorService
    ){}
    public function index()
    {
        $doctor =  $this->doctorService->getAll();
        return response()->json([
            'success'=>true,
            'message'=>'Doctors retrieved successfully',
            'data'=>DoctorResource::collection($doctor),
            'meta'=>[
                'current_page'=>$doctor->currentPage(),
                'last_page'=>$doctor->lastPage(),
                'per_page'=>$doctor->perPage(),
                'total'=>$doctor->total(),
            ]
        ]);
    }
    public function store(StoreDoctorRequest $request)
    {
        $doctor = $this->doctorService->create($request->validated());

        return response()->json([
            'success'=>true,
            'message'=>'Doctors created successfully',
            'data'=>DoctorResource::collection($doctor)],201
        );
    }
    public function show(Doctor $doctor)
    {
        $doctor = $this->doctorService->findById($doctor->id);

        return response()->json([
            'success'=>true,
            'message'=>'Doctors retrieved successfully',
            'data'=> new DoctorResource($doctor)]
        );
    }
    public function update(UpdateDoctorRequest $request,
    Doctor $doctor)
    {
        $doctor = $this->doctorService->
        update($doctor, $request->validated());

        return response()->json([
            'success'=>true,
            'message'=>'Doctors updated successfully',
            'data'=> new DoctorResource($doctor)]
        );
    }

    public function destroy(Doctor $doctor)
    {
        $this->doctorService->delete($doctor);

        return response()->json([
            'success'=>true,
            'message'=>'Doctors deleted successfully',
            'data'=> null]
        );
    }
}

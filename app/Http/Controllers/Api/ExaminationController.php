<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Examination\StoreExaminationRequest;
use App\Http\Requests\Examination\UpdateExaminationRequest;
use App\Http\Resources\ExaminationResource;
use App\Services\ExaminationService;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Models\Examination;

class ExaminationController extends Controller
{
     use ApiResponse;
    public function __construct(
        private ExaminationService $service
    ){        
    }
    public function index() {
        return ExaminationResource::collection(
            $this->service->getAll()
        );
    }
    public function store(StoreExaminationRequest $request)
    {
        $examination = $this->service->create($request->validated());
        return response()->json([
            'success'=> true,
            'message'=>'Examination created successfully',
            'data' => new ExaminationResource($examination)
        ]);
    }
    public function show(Examination $examination)
    {
        $examination = $this ->service->findById($examination->id);
        return response()->json([
            'success' => true,
            'message'=>'Examination retrieved successfully',
            'data' => new ExaminationResource($examination)
        ]);
    }
    public function update(UpdateExaminationRequest $request, Examination $examination)
    {
        $examination = $this->service->update($examination, $request->validated());
        return response()->json([
            'success'=>true,
            'message'=>'Examination updated successfully',
            'data' => new ExaminationResource($examination)
        ]);
    }
}

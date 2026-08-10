<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\AdjuststockRequest;
use App\Http\Requests\Medicine\StoreMedicineRequest;
use App\Http\Requests\Medicine\UpdateMedicineRequest;
use App\Http\Resources\MedicineResource;
use App\Http\Traits\ApiResponse;
use App\Models\Medicine;
use App\Services\MedicineService;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    use ApiResponse;


    public function __construct(
        private MedicineService $medicineService
    ){
    }
    public function index(Request $request)
    {
        return $this->paginatedResponse(MedicineResource::collection(
            $this->medicineService->getAll($request->q)
        ));
    }
    public function store(StoreMedicineRequest $request)
    {
        $medicine = $this->medicineService->create(
            $request->validated()
        );
        return new MedicineResource($medicine);
    }
    public function update(UpdateMedicineRequest $request,
    Medicine $medicine)
    {
        $medicine = $this->medicineService->update(
            $medicine, $request->validated()
        );
        return new MedicineResource($medicine);
    }
    public function show(Medicine $medicine)
    {
        return new MedicineResource($medicine);
    }
    public function destroy(Medicine $medicine)
    {
        $this->medicineService->delete($medicine);
        return response()->json([
            'success'=>true,
            'message'=>'Medicine moved to trash successfully'
        ]);
    }
    public function restore(int $id)
    {
        $medicine = Medicine::withTrashed()->findOrFail($id);
        $medicine->restore();
        return response()->json([
            'success'=>true,
            'message'=>'Medicine restored successfully'
        ]);

    }
    public function forceDelete(int $id)
    {
        $medicine = Medicine::withTrashed()->findOrFail($id);
        $medicine->forceDelete();
        return response()->json([
            'success'=>true,
            'message'=>'Medicine deleted successfully'
        ]);

    }

    public function adjustStock(AdjuststockRequest $request, Medicine $medicine)
    {
        $medicine = $this->medicineService
        ->adjustStock($medicine, $request->validated());
        return new MedicineResource($medicine);
    }

}

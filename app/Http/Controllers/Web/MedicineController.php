<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicine\AdjuststockRequest;
use App\Http\Requests\Medicine\StoreMedicineRequest;
use App\Http\Requests\Medicine\UpdateMedicineRequest;
use App\Models\Medicine;
use App\Services\MedicineService;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class MedicineController extends Controller
{
    public function __construct(
        private MedicineService $medicineService
    ){
    }
    public function index(Request $request)
    {
        $medicines = $this->medicineService
        ->getAll($request->input('q'));

        return view('medicines.index', compact('medicines'));
    }
    public function create() {
        return view('medicines.create');
    }
    public function store(StoreMedicineRequest $request)
    {
        $this->medicineService->create($request->validated());
        return redirect()->route('medicines.index')
        ->with('success', 'Medicine created successfully.');
    }
    public function edit(Medicine $medicine)
    {

        return view('medicines.edit', compact('medicine'));
    }
    public function update(UpdateMedicineRequest $request,
    Medicine $medicine)
    {
        $this->medicineService->update($medicine,
        $request->validated());
        
        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine updated successfully.');
    }
     public function adjustStock(AdjustStockRequest $request,
        Medicine $medicine)
    {
        $this->medicineService->adjustStock(
            $medicine,
            $request->validated()
        );

        return redirect()
            ->route('medicines.index')
            ->with(
                'success',
                'Medicine stock updated successfully.'
            );
    }

    public function adjustStockForm(Medicine $medicine)
    {

        return view('medicines.adjuststock', compact('medicine'));

    }
    public function destroy(Medicine $medicine)
    {
        $this->medicineService->delete($medicine);
        
        return redirect()
            ->route('medicines.index')
            ->with(
                'success',
                'Medicine deactive successfully.'
            );
    }
    public function activate(Medicine $medicine)
    {
        $this->medicineService->activate($medicine);

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine activated successfully.');
     
    }
    public function deactivate(Medicine $medicine)
    {
        $this->medicineService->deactivate($medicine);

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine deactivated successfully.');
     
    }
}

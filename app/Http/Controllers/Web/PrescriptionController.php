<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prescription\AddPrescriptionItemRequest;
use App\Http\Requests\Prescription\StorePrescriptionRequest;
use App\Http\Requests\Prescription\UpdatePrescriptionItemRequest;
use App\Http\Requests\Prescription\UpdatePrescriptionRequest;
use App\Models\Examination;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Services\PrescriptionService;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function __construct(
        private PrescriptionService $service
    ){}

    public function index()
    {
        $prescriptions = $this->service->getAll();

        return view('prescriptions.index', compact('prescriptions'));
    }
    public function create(Examination $examination)
    {
            $examination->load([
            'appointment.patient',
            'appointment.doctor.user',
            'appointment.doctor.specialty',
        ]);

        $medicines = Medicine::query()
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('prescriptions.create', [
            'examination' => $examination,
            'medicines' => $medicines,
        ]);
    }
    public function store(StorePrescriptionRequest $request)
    {
        $data = $request->validated();
        $items = $data['item'];

        unset($data['item']);
        $prescription = $this->service->create($data);
        foreach($items as $item)
        {
            $this->service->addItem($prescription,  $item);
        }

        return redirect()->route('prescriptions.show', $prescription
        )->with('success',
        'Prescription created successfully');
    }

    public function show(Prescription $prescription)
    {
        $prescription = $this->service->findById(
        $prescription->id);

        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $prescription = $this->service->findById($prescription->id);
        $medicines = Medicine::query()->where('is_active', true)
        ->orderBy('name')->get();
        return view('prescriptions.edit',
        compact('prescription', 'medicines'));
    }
    public function update(UpdatePrescriptionRequest $request,
    Prescription $prescription)
    {
        $this->service->update($prescription, $request->validated());

        return redirect()->route('prescriptions.show', $prescription)
        ->with('success', 'Prescription updated successfully');
    }   

    public function addItem(AddPrescriptionItemRequest $request, Prescription $prescription)
    {
        $this->service->addItem($prescription, $request->validated());

        return redirect()->route('prescriptions.edit', $prescription)
         ->with('success', 'Prescription item added successfully');;
    }
    public function updateItem(UpdatePrescriptionItemRequest $request,
    Prescription $prescription, PrescriptionItem $item)
    {
        $this->service->updateItem($prescription, $item, $request->validated());

        return redirect()->route('prescriptions.edit', $prescription)
         ->with('success', 'Prescription item updated successfully');;
    }
    
    public function removeItem(Prescription $prescription,
    PrescriptionItem $item)
    {
        $this->service->removeItem($prescription, $item);

        return redirect()->route('prescriptions.edit', $prescription)
         ->with('success', 'Prescription item removed successfully');;
    }
}

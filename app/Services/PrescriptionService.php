<?php

namespace App\Services;

use App\Events\PrescriptionCreated;
use App\Models\Examination;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PrescriptionService
{
    // ensure that only none Invoiced Prescription can be updating
    private function ensurePrescriptionIsNotInvoiced(Prescription $prescription)
    {
        if($prescription->examination->invoice()->exists())
        {
            throw ValidationException::withMessages([
                'prescription'=>['Cannot modify prescription because
                an invoice has already been generated']
            ]);
        }
    }


    private function ensureItemBelongsToPrescription(
        Prescription $prescription,
        PrescriptionItem $item
    ): void {
        if ($item->prescription_id !== $prescription->id) {
            throw ValidationException::withMessages([
                'item' => [
                    'The prescription item does not belong to this prescription.',
                ],
            ]);
        }
    }

    public function getAll(int $perPage = 10)
    {
        return Prescription::query()->with([
            'examination.appointment.patient',
            'doctor.user',
            'items.medicine'
        ])->latest()->paginate($perPage);
    }
    public function findById(int $id)
    {
        return Prescription::query()->with([
            'examination.appointment.patient',
                'examination.appointment.doctor.user',
                'doctor.user',
                'items.medicine',
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use($data){
            $examination = Examination::with(['appointment.doctor'])
            ->findOrFail($data['examination_id']);

            if($examination->prescription()->exists())
            {
                throw ValidationException::withMessages([
                    'examination_id'=>
                    ['This examination already has a prescription']
                ]);
            }
            if(!$examination->appointment)
            {
                throw ValidationException::withMessages([
                    'examination_id'=>
                    ['This examination is not associated with an appointment']
                ]);
            }

            $doctorId = $examination->appointment->doctor_id;
            $prescription = Prescription::create([
                'examination_id'=>$examination->id,
                'doctor_id' => $doctorId,
                'note' => $data['note'] ?? null,
            ]);

            foreach($data['item'] ?? [] as $item)
            {
                $prescription->items()->create([
                    'medicine_id' => $item['medicine_id'],
                    'quantity' => $item['quantity'],
                    'dousage' => $item['dousage'],
                    'usage_instruction' => $item['usage_instruction'],
                ]);
            }

            event(new PrescriptionCreated($prescription));  
            return $prescription->load([
                'examination', 'doctor.user', 'items.medicine'
            ]);

        });
    }

    public function update(Prescription $prescription, array $data)
    {
        $this->ensurePrescriptionIsNotInvoiced($prescription);
        $prescription->update([
            'note'=> $data['note'] ?? null,
        ]);
        return $prescription->load([
            'examination.appointment.patient',
            'doctor.user',
            'items.medicine'
        ]);
    }

    //...ITEM...

    public function createItem(Prescription $prescription, array $data)
    {
        $this->ensurePrescriptionIsNotInvoiced($prescription);
        $medicine = Medicine::query()->lockForUpdate()
        ->findOrFail($data['medicine_id']);

        if(!$medicine->is_active)
        {
            throw ValidationException::withMessages([
                'medicine_id' => ['Medicine is inactive and cannot be prescribed']
            ]);
        }
        if(PrescriptionItem::where('prescription_id', 
        $prescription->id)->where('medicine_id', $medicine->id)
        ->exists())
        {
            throw ValidationException::withMessages([
                'medicine_id'=>['This medicine is already in the prescription']
            ]);
        }
        if ($medicine->stock < $data['quantity']) {
            throw ValidationException::withMessages([
                'quantity' => [
                    'Not enough medicine in stock.',
                ],
            ]);
        }

        $medicine->decrement(
            'stock',
            $data['quantity']
        );

        return $prescription->items()->create([
            'medicine_id' => $data['medicine_id'],
            'quantity' => $data['quantity'],
            'dousage' => $data['dousage'],
            'usage_instruction' => $data['usage_instruction'],
        ]);
            

    }

    public function addItem(Prescription $prescription, array $data)
    {
        return DB::transaction(function () use ($prescription, $data){
            return $this->createItem($prescription, $data);
        });
    }
    
    

    public function updateItem(Prescription $prescription, 
    PrescriptionItem $item, array $data)
    {
        return DB::transaction(function() use($prescription,
        $item, $data){
            $this->ensurePrescriptionIsNotInvoiced($prescription);
            $this->ensureItemBelongsToPrescription($prescription, $item);
            $oldQuantity = $item->quantity;
            $newQuantity = $data['quantity'];       
            
            $different = $newQuantity - $oldQuantity;

            if($different > 0)
            {
                $medicine = Medicine::query()->lockForUpdate()
                ->findOrFail($item->medicine_id);

                if(!$medicine -> is_active)
                {
                    throw ValidationException::withMessages([
                        'medicine_id' => ['Medicine is inactive']
                    ]);
                }
                if($medicine->stock < $different)
                {
                    throw ValidationException::withMessages([
                        'quantity' => ['Not enough medicine in stock']
                    ]);
                }
                $medicine->decrement('stock', $different);
            }
            if($different < 0)
            {
                $medicine = Medicine::query()->lockForUpdate()
                ->findOrFail($item->medicine_id);

                $medicine->increment('stock', abs($different));

            }
            $item->update([
                'quantity' => $newQuantity,
                'dousage' => $data['dousage'],
                'usage_instruction' => $data['usage_instruction']
            ]);
            return $item->load('medicine');
        });  
    }
    public function removeItem(Prescription $prescription,
        PrescriptionItem $item
    ): void {
        DB::transaction(function () use (
            $prescription,
            $item
        ) {
            $this->ensurePrescriptionIsNotInvoiced($prescription);
            $this->ensureItemBelongsToPrescription(
                $prescription,
                $item
            );

            $medicine = Medicine::query()
                ->lockForUpdate()
                ->findOrFail($item->medicine_id);

            $medicine->increment(
                'stock',
                $item->quantity
            );

            $item->delete();
        });
    }
}
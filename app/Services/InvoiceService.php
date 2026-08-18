<?php

namespace App\Services;

use App\Events\InvoiceCreated;
use App\Events\InvoiceUpdated;
use App\Models\Examination;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Console\Input\InputOption;

class InvoiceService
{
    public function getAll(array $filters, int $perPage = 5)
    {
        return Invoice::query()->with(['examination.appointment.patient'])
        ->when($filters['full_name'] ?? null, function ($q, $fullName) {
            $q->whereHas('examination.appointment.patient', 
            function ($query) use ($fullName) {
                $query->where('full_name', 'ILIKE', "%{$fullName}%");
            });
        })

        ->when($filters['date'] ?? null,
        function($q, $date){
            $q->whereDate('issued_at', $date);
        })->latest()->paginate($perPage);
    }

    public function generateCode():string{
        $lastInvoice = Invoice::latest('id')->first();
        if(!$lastInvoice)
        {
            return 'IV000001';
        }
        $lastNumber = (int) substr($lastInvoice->invoice_code, 2);

        return 'IV' . str_pad($lastNumber + 1, 6,'0',STR_PAD_LEFT);
    }


    public function create(array $data)
    {
        return DB::transaction(function() use($data)
        {
            $examination = Examination::query()
            ->with([
                'appointment',
                'prescription.items.medicine',
            ])
            ->findOrFail($data['examination_id']);
            if ($examination->invoice()->exists()) 
            {
                throw ValidationException::withMessages([
                    'examination_id' => [
                        'This examination already has an invoice.',
                    ],
                ]);
            }
            $medicineTotal = $examination->prescription ?->items
            ->sum(function ($item){
                return $item->quantity * $item->medicine->price;
            }) ?? 0;

            $subtotal = $medicineTotal + $examination->examination_fee;
            $invoice = Invoice::create([
                'examination_id' => $examination->id,
                'invoice_code' => $this->generateCode(),
                'subtotal' =>   $subtotal,
                'discount' => $data['discount'],
                'total' => $subtotal - $data['discount'],
                'status' => 'unpaid',
                'issued_at' => now(),
            ]);
            event(new InvoiceCreated($invoice));
            return $invoice->load([
                'examination.appointment.patient',
                'examination.prescription.items.medicine',
            ]);
        });
    }
    public function findById(int $id)
    {
        return Invoice::with('examination')->findOrFail($id);
    }
    public function update(array $data, Invoice $invoice)
    {
        $oldDiscount = $invoice->discount;
        $newDiscount = $data['discount'];

        if($invoice->status !=='unpaid')
        {
            abort(422, 'Only unpaid invoice can be updated');
        }
        if ($newDiscount < 0) {
            throw ValidationException::withMessages([
                'discount' => ['Discount cannot be negative.'],
            ]);
        }

        if ($newDiscount > $invoice->subtotal) {
            throw ValidationException::withMessages([
                'discount' => ['Discount cannot exceed subtotal.'],
            ]);
        }
        $invoice->update([
        'discount' => $newDiscount,
        'total' => $invoice->subtotal - $newDiscount,
        ]);

        event(new InvoiceUpdated($invoice, $oldDiscount, $newDiscount));
        return $invoice->fresh([
        'examination.appointment.patient',
        'examination.prescription.items.medicine',
    ]);
    }
    private array $statusTransition = [
        'unpaid' => ['paid', 'cancelled'],
        'paid' => [],
        'cancelled' => []
    ];

    public function updateStatus(Invoice $invoice, string $status)
    {
        $currentStatus = $invoice->status;
        if(!isset($this->statusTransition[$currentStatus]) || 
        !in_array($status, $this->statusTransition[$currentStatus]))
        {
            abort(422, "cannot change status from {$currentStatus} to
            {$status}");
        }
        $invoice->update(['status'=>$status]);
        return $invoice;
    }
}
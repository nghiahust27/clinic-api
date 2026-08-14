<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceStatusRequest;
use App\Models\Examination;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class InvoiceController extends Controller
{
    public function __construct(
        private InvoiceService $invoiceService
    ){
    }
    public function index(Request $request)
    {
        $invoices = $this->invoiceService
        ->getAll($request->only(['full_name', 'date']));
        return view('invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        $invoice ->load([
            'examination'
        ]);
        return view('invoices.show', compact('invoice'));
    }

    public function create(Examination $examination)
    {
        $examination->load([
        'appointment.patient',
        'appointment.doctor.user',
        'appointment.doctor.specialty',
    ]);
        return view('invoices.create', compact('examination'));

    }
    public function store(StoreInvoiceRequest $request)
    {
        // dd($request->validated());
        $invoice= $this->invoiceService->create($request->validated());
        return redirect()->route('invoices.show', $invoice)
        ->with('success',
        'Invoice created successfully');

    }

    public function edit(Invoice $invoice)
    {
        $invoice->load([
        'examination.appointment.patient',
        'examination.appointment.doctor.user',
        'examination.appointment.doctor.specialty',
    ]);
        return view('invoices.edit', compact('invoice'));
    }
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $this->invoiceService->update($request->validated(), $invoice);

        return redirect()->route('invoices.show', $invoice)
        ->with('success', 'Invoice updated successfully');
    }
    public function updateStatus(UpdateInvoiceStatusRequest $request,
    Invoice $invoice)
    {   
        $this->invoiceService->updateStatus($invoice,
         $request->validated('status'));
        return redirect()->route('invoices.show', $invoice)
        ->with('success', 'Invoice status updated successfully');
    }
}

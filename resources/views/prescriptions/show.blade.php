@extends('layouts.app')

@section('title', 'Prescription Details')

@push('styles')
<style>
/* =========================================
   PRESCRIPTION SHOW
========================================= */

.prescription-show-page {
    max-width: 1150px;
    margin: 0 auto;
}

/* HEADER */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.page-header h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #172033;
    letter-spacing: -0.5px;
}

.page-header p {
    margin: 6px 0 0;
    color: #64748b;
    font-size: 14px;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* INFO CARD */
.prescription-info-card {
    display: grid;
    grid-template-columns: 1fr 1fr 220px;
    gap: 20px;
    padding: 20px 24px;
    margin-bottom: 20px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.prescription-info-item {
    min-width: 0;
}

.prescription-info-label {
    margin-bottom: 10px;
    color: #94a3b8;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
}

.prescription-person {
    display: flex;
    align-items: center;
    gap: 12px;
}

.prescription-avatar {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 50%;
    background: #eff6ff;
    color: #2563eb;
    font-size: 14px;
    font-weight: 700;
}

.doctor-avatar {
    background: #ecfdf5;
    color: #059669;
}

.prescription-person-name {
    color: #1e293b;
    font-size: 14px;
    font-weight: 600;
}

.prescription-person-meta {
    margin-top: 3px;
    color: #64748b;
    font-size: 12px;
}

.prescription-examination {
    display: flex;
    flex-direction: column;
    gap: 4px;
    color: #64748b;
    font-size: 12px;
}

.prescription-examination strong {
    color: #2563eb;
    font-size: 14px;
}

.small-link {
    margin-top: 4px;
    color: #2563eb;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.15s ease;
}

.small-link:hover {
    color: #1d4ed8;
    text-decoration: underline;
}

/* CARD GENERAL */
.prescription-card {
    margin-bottom: 20px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    border-bottom: 1px solid #f1f5f9;
    background: #ffffff;
}

.card-header h2 {
    margin: 0;
    color: #0f172a;
    font-size: 16px;
    font-weight: 700;
}

.card-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 12px;
}

.card-body {
    padding: 20px 24px;
}

.medicine-count {
    padding: 6px 12px;
    border-radius: 20px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 600;
}

/* MEDICINE LIST */
.prescription-medicine-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.prescription-medicine {
    display: grid;
    grid-template-columns: 34px minmax(180px, 1.4fr) 100px 110px minmax(220px, 1.7fr);
    align-items: center;
    gap: 16px;
    padding: 16px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: #f8fafc;

    /* Transition mượt mà cho Hover & Active */
    transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1),
                box-shadow 0.2s ease,
                border-color 0.2s ease;
    will-change: transform;
}

.prescription-medicine:hover {
    transform: scale(1.015) translateX(3px);
    border-color: #cbd5e1;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.medicine-number {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 700;
}

.medicine-main {
    min-width: 0;
}

.medicine-name {
    color: #1e293b;
    font-size: 14px;
    font-weight: 600;
}

.medicine-unit {
    margin-top: 3px;
    color: #64748b;
    font-size: 12px;
}

.medicine-detail {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.medicine-detail-label {
    color: #94a3b8;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
}

.medicine-detail strong {
    color: #1e293b;
    font-size: 13px;
}

.medicine-instruction {
    min-width: 0;
    color: #334155;
    font-size: 13px;
    line-height: 1.5;
}

/* NOTE DISPLAY */
.prescription-note-display {
    padding: 16px;
    border: 1px solid #cbd5e1;
    border-left: 4px solid #2563eb;
    border-radius: 8px;
    background: #f8fafc;
    color: #1e293b;
    font-size: 13px;
    line-height: 1.6;
    white-space: pre-line;
}

/* PLACEHOLDER */
.medical-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    min-height: 120px;
    color: #94a3b8;
    text-align: center;
    font-size: 13px;
}

.medical-placeholder-icon {
    margin-bottom: 8px;
    color: #cbd5e1;
    font-size: 28px;
}

/* ALERT */
.alert {
    padding: 12px 16px;
    margin-bottom: 20px;
    border-radius: 8px;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #047857;
    font-size: 13px;
    font-weight: 500;
}

/* META */
.prescription-meta {
    display: flex;
    justify-content: flex-end;
    gap: 18px;
    margin-top: -8px;
    margin-bottom: 24px;
    color: #94a3b8;
    font-size: 11px;
}

/* BUTTONS */
.prescription-btn {
    min-height: 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    
    /* Animation cho nút */
    transition: transform 0.15s ease, background-color 0.15s ease, box-shadow 0.15s ease;
    will-change: transform;
}

.prescription-btn:hover {
    transform: scale(1.03) translateY(-1px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
}

.prescription-btn:active {
    transform: scale(0.97) translateY(1px);
    box-shadow: none;
}

.prescription-btn-primary {
    border: 1px solid #2563eb;
    background: #2563eb;
    color: #ffffff;
}

.prescription-btn-primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
}

.prescription-btn-secondary {
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #475569;
}

.prescription-btn-secondary:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #1e293b;
}

/* RESPONSIVE */
@media (max-width: 1000px) {
    .prescription-info-card {
        grid-template-columns: 1fr 1fr;
    }
    .prescription-medicine {
        grid-template-columns: 34px 1fr 100px 100px;
    }
    .medicine-instruction {
        grid-column: 2 / -1;
    }
}

@media (max-width: 650px) {
    .prescription-info-card {
        grid-template-columns: 1fr;
    }
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
    }
    .header-actions {
        width: 100%;
    }
    .header-actions .prescription-btn {
        flex: 1;
    }
    .prescription-medicine {
        grid-template-columns: 34px 1fr;
    }
    .medicine-detail,
    .medicine-instruction {
        grid-column: 2;
    }
}
</style>
@endpush

@section('content')
<div class="prescription-show-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1>Prescription Details</h1>
            <p>Prescription #{{ $prescription->id }}</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('examinations.show', $prescription->examination) }}" class="prescription-btn prescription-btn-secondary">
                ← Back
            </a>

            @if(!isset($prescription->examination->invoice))
                @if(auth()->user()->hasPermission('PRESCRIPTIONS.UPDATE'))
                    <a href="{{ route('prescriptions.edit', $prescription) }}" class="prescription-btn prescription-btn-primary">
                        Edit
                    </a>
                @endif
                @if(auth()->user()->hasPermission('INVOICES.CREATE'))
                    <a href="{{ route('examinations.invoices.create', [$prescription->examination]) }}" class="prescription-btn prescription-btn-primary">
                        Create Invoice
                    </a>
                @endif
            @else
                @if(auth()->user()->hasPermission('INVOICES.FINDONE'))
                    <a href="{{ route('invoices.show', [$prescription->examination->invoice]) }}" class="prescription-btn prescription-btn-primary">
                        View Invoice
                    </a>
                @endif
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- PATIENT / DOCTOR / EXAMINATION INFO CARD --}}
    <div class="prescription-info-card">
        {{-- PATIENT --}}
        <div class="prescription-info-item">
            <div class="prescription-info-label">PATIENT</div>
            <div class="prescription-person">
                <div class="prescription-avatar">
                    {{ strtoupper(substr($prescription->examination->appointment->patient->full_name ?? 'P', 0, 1)) }}
                </div>
                <div>
                    <div class="prescription-person-name">
                        {{ $prescription->examination->appointment->patient->full_name ?? 'N/A' }}
                    </div>
                    <div class="prescription-person-meta">
                        {{ $prescription->examination->appointment->patient->phone ?? 'No phone number' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- DOCTOR --}}
        <div class="prescription-info-item">
            <div class="prescription-info-label">DOCTOR</div>
            <div class="prescription-person">
                <div class="prescription-avatar doctor-avatar">
                    {{ strtoupper(substr($prescription->doctor->user->name ?? 'D', 0, 1)) }}
                </div>
                <div>
                    <div class="prescription-person-name">
                        Dr. {{ $prescription->doctor->user->name ?? 'N/A' }}
                    </div>
                    <div class="prescription-person-meta">
                        Attending Doctor
                    </div>
                </div>
            </div>
        </div>

        {{-- EXAMINATION --}}
        <div class="prescription-info-item">
            <div class="prescription-info-label">EXAMINATION</div>
            <div class="prescription-examination">
                <strong>#{{ $prescription->examination_id }}</strong>
                <span>
                    {{ $prescription->examination->examinated_at 
                        ? \Carbon\Carbon::parse($prescription->examination->examinated_at)->format('d M Y, H:i') 
                        : 'N/A' }}
                </span>
                <a href="{{ route('examinations.show', ['examination' => $prescription->examination_id]) }}" class="small-link">
                    View examination
                </a>
            </div>
        </div>
    </div>

    {{-- MEDICINES CARD --}}
    <div class="prescription-card">
        <div class="card-header">
            <div>
                <h2>Prescribed Medicines</h2>
                <p>Medicines included in this prescription.</p>
            </div>
            <div class="medicine-count">
                {{ $prescription->items->count() }} {{ Str::plural('medicine', $prescription->items->count()) }}
            </div>
        </div>

        <div class="card-body">
            @if($prescription->items->count())
                <div class="prescription-medicine-list">
                    @foreach($prescription->items as $index => $item)
                        <div class="prescription-medicine">
                            {{-- NUMBER --}}
                            <div class="medicine-number">
                                {{ $index + 1 }}
                            </div>

                            {{-- MEDICINE NAME & UNIT --}}
                            <div class="medicine-main">
                                <div class="medicine-name">
                                    {{ $item->medicine->name ?? 'Unknown Medicine' }}
                                </div>
                                <div class="medicine-unit">
                                    Unit: {{ $item->medicine->unit ?? 'N/A' }}
                                </div>
                            </div>

                            {{-- QUANTITY --}}
                            <div class="medicine-detail">
                                <span class="medicine-detail-label">Quantity</span>
                                <strong>{{ $item->quantity }}</strong>
                            </div>

                            {{-- DOSAGE --}}
                            <div class="medicine-detail">
                                <span class="medicine-detail-label">Dosage</span>
                                <strong>{{ $item->dosage ?? $item->dousage ?? 'N/A' }}</strong>
                            </div>

                            {{-- INSTRUCTION --}}
                            <div class="medicine-instruction">
                                <span class="medicine-detail-label">Usage Instruction</span>
                                <div>{{ $item->usage_instruction ?? 'No instruction' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="medical-placeholder">
                    <div class="medical-placeholder-icon">♡</div>
                    <div>No medicines have been added to this prescription.</div>
                </div>
            @endif
        </div>
    </div>

    {{-- PRESCRIPTION NOTE CARD --}}
    <div class="prescription-card">
        <div class="card-header">
            <div>
                <h2>Prescription Note</h2>
            </div>
        </div>

        <div class="card-body">
            @if($prescription->note)
                <div class="prescription-note-display">
                    {{ $prescription->note }}
                </div>
            @else
                <div class="medical-placeholder">
                    <div class="medical-placeholder-icon">♡</div>
                    <div>No prescription note provided.</div>
                </div>
            @endif
        </div>
    </div>

    {{-- TIMESTAMPS --}}
    <div class="prescription-meta">
        <span>Created: {{ optional($prescription->created_at)->format('d M Y, H:i') ?? 'N/A' }}</span>
        <span>Updated: {{ optional($prescription->updated_at)->format('d M Y, H:i') ?? 'N/A' }}</span>
    </div>

</div>
@endsection
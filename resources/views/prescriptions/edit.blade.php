@extends('layouts.app')

@section('title', 'Edit Prescription')

@push('styles')
<style>
/* =========================================
   PRESCRIPTION EDIT - GRID LAYOUT
========================================= */

.prescription-edit-page {
    max-width: 1200px;
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
    margin-bottom: 24px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.prescription-info-item {
    min-width: 0;
}

.prescription-info-label {
    margin-bottom: 8px;
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
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #eff6ff;
    color: #2563eb;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
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
    margin-top: 2px;
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
    color: #2563eb;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
}

.small-link:hover {
    text-decoration: underline;
}

/* MAIN LAYOUT GRID (2 COLUMNS) */
.edit-layout-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 24px;
    align-items: start;
}

/* CARDS GENERAL */
.card {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    margin-bottom: 24px;
    overflow: hidden;
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
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
    padding: 20px;
}

.medicine-count {
    padding: 5px 12px;
    border-radius: 20px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 600;
}

/* FORM CONTROLS */
.form-group {
    margin-bottom: 16px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-label {
    display: block;
    margin-bottom: 6px;
    color: #334155;
    font-size: 12px;
    font-weight: 600;
}

.form-input {
    width: 100%;
    min-height: 40px;
    box-sizing: border-box;
    padding: 8px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background: #ffffff;
    color: #1e293b;
    font-size: 13px;
    outline: none;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}

.form-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.field-error {
    margin-top: 5px;
    color: #dc2626;
    font-size: 11px;
}

.form-actions-right {
    display: flex;
    justify-content: flex-end;
    margin-top: 16px;
}

/* ADD MEDICINE FORM GRID */
.add-medicine-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.add-medicine-grid .full-width {
    grid-column: 1 / -1;
}

/* MEDICINE ITEMS LIST */
.edit-medicine-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.edit-medicine-item {
    padding: 16px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: #f8fafc;
    transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.2s ease;
}

.edit-medicine-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    background: #ffffff;
}

.edit-medicine-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
}

.edit-medicine-name {
    display: flex;
    align-items: center;
    gap: 12px;
}

.medicine-number {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 700;
}

.edit-medicine-name strong {
    display: block;
    color: #1e293b;
    font-size: 14px;
}

.edit-medicine-name span {
    display: block;
    margin-top: 2px;
    color: #64748b;
    font-size: 12px;
}

.remove-medicine {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #fecaca;
    border-radius: 8px;
    background: #ffffff;
    color: #ef4444;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.15s ease;
}

.remove-medicine:hover {
    border-color: #ef4444;
    background: #fef2f2;
    transform: scale(1.05);
}

.edit-medicine-fields {
    display: grid;
    grid-template-columns: 90px 140px 1fr auto;
    align-items: end;
    gap: 12px;
}

.edit-medicine-fields .form-group {
    margin-bottom: 0;
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
    transition: transform 0.15s ease, background-color 0.15s ease, box-shadow 0.15s ease;
    will-change: transform;
}

.prescription-btn:hover {
    transform: scale(1.02) translateY(-1px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
}

.prescription-btn:active {
    transform: scale(0.98) translateY(1px);
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

.btn-full {
    width: 100%;
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .edit-layout-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .prescription-info-card {
        grid-template-columns: 1fr;
    }
    .edit-medicine-fields {
        grid-template-columns: 1fr 1fr;
    }
    .edit-medicine-fields .form-group:nth-child(3) {
        grid-column: 1 / -1;
    }
    .edit-item-action {
        grid-column: 1 / -1;
    }
    .edit-item-action button {
        width: 100%;
    }
    .add-medicine-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<div class="prescription-edit-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1>Edit Prescription</h1>
            <p>Prescription #{{ $prescription->id }}</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('prescriptions.show', ['prescription' => $prescription->id]) }}" class="prescription-btn prescription-btn-secondary">
                ← Back
            </a>
        </div>
    </div>

    {{-- PATIENT / DOCTOR / EXAMINATION INFO --}}
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
                <a href="{{ route('examinations.show', ['examination' => $prescription->examination_id]) }}" class="small-link">
                    View examination
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN GRID: LEFT (MEDICINES) & RIGHT (NOTE / ACTIONS) --}}
    <div class="edit-layout-grid">

        {{-- LEFT COLUMN: MEDICINE MANAGEMENT --}}
        <div class="edit-main-col">

            {{-- ADD MEDICINE CARD --}}
            @if(auth()->user()->hasPermission('PRESCRIPTIONS.ADDITEM'))
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h2>Add Medicine</h2>
                            <p>Select and add a new medicine to this prescription.</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('prescriptions.items.store', ['prescription' => $prescription->id]) }}">
                            @csrf

                            <div class="add-medicine-grid">
                                {{-- MEDICINE --}}
                                <div class="form-group full-width">
                                    <label class="form-label">Medicine</label>
                                    <select name="medicine_id" class="form-input" required>
                                        <option value="">Select medicine...</option>
                                        @foreach($medicines as $medicine)
                                            <option value="{{ $medicine->id }}">
                                                {{ $medicine->name }} ({{ $medicine->unit }}) — Stock: {{ $medicine->stock }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('medicine_id')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- QUANTITY --}}
                                <div class="form-group">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" min="1" class="form-input" placeholder="e.g. 10" required>
                                    @error('quantity')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- DOSAGE --}}
                                <div class="form-group">
                                    <label class="form-label">Dosage</label>
                                    <input type="text" name="dousage" class="form-input" placeholder="e.g. 1 tablet" required>
                                    @error('dousage')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- USAGE INSTRUCTION --}}
                                <div class="form-group full-width">
                                    <label class="form-label">Usage Instruction</label>
                                    <input type="text" name="usage_instruction" class="form-input" placeholder="e.g. After meals, twice daily" required>
                                    @error('usage_instruction')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-actions-right">
                                <button type="submit" class="prescription-btn prescription-btn-primary">
                                    + Add Medicine
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            {{-- CURRENT MEDICINES LIST CARD --}}
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2>Prescribed Medicines</h2>
                        <p>Update quantity, dosage or remove medicines.</p>
                    </div>
                    <div class="medicine-count">
                        {{ $prescription->items->count() }} {{ Str::plural('medicine', $prescription->items->count()) }}
                    </div>
                </div>

                <div class="card-body">
                    @if($prescription->items->count())
                        <div class="edit-medicine-list">
                            @foreach($prescription->items as $item)
                                <div class="edit-medicine-item">
                                    <div class="edit-medicine-top">
                                        <div class="edit-medicine-name">
                                            <div class="medicine-number">{{ $loop->iteration }}</div>
                                            <div>
                                                <strong>{{ $item->medicine->name ?? 'Unknown' }}</strong>
                                                <span>Unit: {{ $item->medicine->unit ?? 'N/A' }}</span>
                                            </div>
                                        </div>

                                        @if(auth()->user()->hasPermission('PRESCRIPTIONS.REMOVEITEM'))
                                            <form method="POST" action="{{ route('prescriptions.items.destroy', ['prescription' => $prescription->id, 'item' => $item->id]) }}" onsubmit="return confirm('Remove this medicine?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="remove-medicine" title="Remove medicine">
                                                    ✕
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                    {{-- UPDATE ITEM FORM --}}
                                    @if(auth()->user()->hasPermission('PRESCRIPTIONS.UPDATEITEM'))
                                        <form method="POST" action="{{ route('prescriptions.items.update', ['prescription' => $prescription->id, 'item' => $item->id]) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="edit-medicine-fields">
                                                <div class="form-group">
                                                    <label class="form-label">Qty</label>
                                                    <input type="number" name="quantity" min="1" value="{{ old('quantity', $item->quantity) }}" class="form-input" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Dosage</label>
                                                    <input type="text" name="dousage" value="{{ old('dousage', $item->dosage ?? $item->dousage) }}" class="form-input" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Instruction</label>
                                                    <input type="text" name="usage_instruction" value="{{ old('usage_instruction', $item->usage_instruction) }}" class="form-input" required>
                                                </div>

                                                <div class="edit-item-action">
                                                    <button type="submit" class="prescription-btn prescription-btn-primary">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="medical-placeholder">
                            <div class="medical-placeholder-icon">♡</div>
                            <div>No medicines have been added to this prescription yet.</div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN: NOTE & ACTIONS --}}
        <div class="edit-sidebar-col">

            {{-- PRESCRIPTION NOTE CARD --}}
            @if(auth()->user()->hasPermission('PRESCRIPTIONS.UPDATE'))
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h2>Prescription Note</h2>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('prescriptions.update', ['prescription' => $prescription->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <textarea name="note" rows="5" class="form-input" style="resize: vertical;" placeholder="Enter prescription note or advice...">{{ old('note', $prescription->note) }}</textarea>
                                @error('note')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="prescription-btn prescription-btn-primary btn-full" style="margin-top: 12px;">
                                Save Note
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            {{-- QUICK NAVIGATION CARD --}}
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('prescriptions.show', ['prescription' => $prescription->id]) }}" class="prescription-btn prescription-btn-secondary btn-full">
                        View Prescription
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
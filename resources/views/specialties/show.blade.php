@extends('layouts.app')

@section('title', 'Specialty Details - ' . $specialty->name)

@section('content')
<style>
.show-page-container {
    max-width: 1000px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.page-header h1 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.4px;
}

.page-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 13px;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Detail Card */
.detail-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    padding: 24px;
    margin-bottom: 28px;
}

.detail-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
}

.detail-label {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 6px;
}

.detail-value-title {
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 8px 0;
}

.detail-value-desc {
    color: #334155;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}

.meta-box {
    background: #f8fafc;
    border: 1px solid #f1f5f9;
    border-radius: 10px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.meta-box .count {
    font-size: 28px;
    font-weight: 800;
    color: #2563eb;
    line-height: 1;
}

.meta-box .label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    margin-top: 6px;
}

/* Doctors Section */
.section-title {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.badge-count {
    background: #e0e7ff;
    color: #4338ca;
    font-size: 12px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 12px;
}

.table-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    font-size: 14px;
}

.custom-table th {
    background: #f8fafc;
    padding: 12px 20px;
    color: #475569;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #e2e8f0;
}

.custom-table td {
    padding: 14px 20px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
    color: #334155;
}

.custom-table tbody tr:last-child td {
    border-bottom: none;
}

.custom-table tbody tr:hover {
    background-color: #f8fafc;
}

.doctor-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.doctor-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #dbeafe;
    color: #1d4ed8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
}

.doctor-name {
    font-weight: 600;
    color: #0f172a;
}

.text-muted {
    color: #64748b;
    font-size: 13px;
}

.empty-state {
    text-align: center;
    padding: 40px 20px !important;
    color: #94a3b8;
}

/* Buttons */
.btn {
    min-height: 38px;
    padding: 0 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all .15s ease;
}

.btn-primary {
    background: #2563eb;
    color: #ffffff;
    border: 1px solid #2563eb;
}

.btn-primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
}

.btn-secondary {
    background: #ffffff;
    color: #64748b;
    border: 1px solid #cbd5e1;
}

.btn-secondary:hover {
    background: #f8fafc;
    color: #0f172a;
}

@media (max-width: 640px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="show-page-container">

    <div class="page-header">
        <div>
            <h1>Specialty Overview</h1>
            <p>Viewing details and assigned medical personnel</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('specialties.index') }}" class="btn btn-secondary">
                ← Back
            </a>
            <a href="{{ route('specialties.edit', $specialty) }}" class="btn btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        </div>
    </div>

    {{-- Specialty Info Card --}}
    <div class="detail-card">
        <div class="detail-grid">
            <div>
                <div class="detail-label">Specialty Name</div>
                <h2 class="detail-value-title">{{ $specialty->name }}</h2>

                <div class="detail-label" style="margin-top: 16px;">Description</div>
                <p class="detail-value-desc">
                    {{ $specialty->description ?: 'No detailed description provided for this specialty.' }}
                </p>
            </div>

            <div class="meta-box">
                <span class="count">{{ $specialty->doctors->count() }}</span>
                <span class="label">Assigned Doctors</span>
            </div>
        </div>
    </div>

    {{-- Doctors List Section --}}
    <div class="section-title">
        <span>Doctors in this Specialty</span>
        <span class="badge-count">{{ $specialty->doctors->count() }}</span>
    </div>

    <div class="table-card">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 40%;">Doctor Name</th>
                    <th style="width: 35%;">Email</th>
                    <th style="width: 25%;">License Number</th>
                </tr>
            </thead>
            <tbody>
                @forelse($specialty->doctors as $doctor)
                    <tr>
                        <td>
                            <div class="doctor-info">
                                <div class="doctor-avatar">
                                    {{ strtoupper(substr($doctor->user->name ?? $doctor->name ?? 'D', 0, 1)) }}
                                </div>
                                <span class="doctor-name">
                                    {{ $doctor->user->name ?? $doctor->name ?? 'N/A' }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted">
                                {{ $doctor->user->email ?? $doctor->email ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            <span class="text-muted">
                                {{ $doctor->phone ?? $doctor->license_number  }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty-state">
                            No doctors are currently assigned to this specialty.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
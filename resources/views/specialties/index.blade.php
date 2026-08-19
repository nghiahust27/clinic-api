@extends('layouts.app')

@section('title', 'Specialties List')

@section('content')
<style>
.specialties-page {
    max-width: 1100px;
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
    font-size: 26px;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.5px;
}

.page-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 14px;
}

.specialty-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    font-size: 14px;
}

.custom-table th {
    background: #f8fafc;
    padding: 14px 20px;
    color: #475569;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #e2e8f0;
}

.custom-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
    color: #334155;
}

.custom-table tbody tr:last-child td {
    border-bottom: none;
}

.custom-table tbody tr:hover {
    background-color: #f8fafc;
}

.specialty-title {
    font-weight: 600;
    color: #0f172a;
    font-size: 15px;
}

.specialty-desc {
    color: #64748b;
    line-height: 1.5;
    max-width: 650px;
}

.text-muted-empty {
    color: #94a3b8;
    font-style: italic;
}

/* Action Buttons */
.action-group {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #64748b;
    transition: all 0.15s ease;
}

.btn-action:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.btn-action.btn-delete:hover {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    min-height: 40px;
    padding: 0 16px;
    background: #2563eb;
    color: #ffffff;
    border: 1px solid #2563eb;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.15s ease;
}

.btn-primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
}

.alert-success {
    padding: 12px 16px;
    background-color: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    color: #166534;
    font-size: 14px;
    margin-bottom: 20px;
}

.empty-state {
    text-align: center;
    padding: 40px 20px !important;
    color: #94a3b8;
}

.card-footer {
    padding: 14px 20px;
    border-top: 1px solid #f1f5f9;
    background: #ffffff;
}
.btn-action.btn-show:hover {
    background: #eff6ff;
    color: #2563eb;
    border-color: #bfdbfe;
} .pagination {
        padding: 18px 20px;

        border-top: 1px solid #edf4f4;
    }

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 28px;
    padding-bottom: 10px;
}

.pagination-wrapper nav {
    display: flex;
    align-items: center;
}

.pagination-wrapper nav > div:first-child {
    display: none;
}

.pagination-wrapper nav > div:last-child {
    display: flex;
    align-items: center;
}

.pagination-wrapper nav ul {
    display: flex;
    align-items: center;
    gap: 6px;

    margin: 0;
    padding: 0;

    list-style: none;
}

.pagination-wrapper nav li {
    margin: 0;
    padding: 0;
}


/* PAGINATION BUTTON */

.pagination-wrapper nav a,
.pagination-wrapper nav span {
    min-width: 36px;
    height: 36px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 10px;

    box-sizing: border-box;

    border: 1px solid #e5e7eb;
    border-radius: 8px;

    background: #ffffff;
    color: #4b5563;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    transition:
        background .15s ease,
        border-color .15s ease,
        color .15s ease,
        box-shadow .15s ease;
}


/* HOVER */

.pagination-wrapper nav a:hover {
    border-color: #bfdbfe;
    background: #eff6ff;
    color: #2563eb;
}


/* ACTIVE PAGE */

.pagination-wrapper nav span[aria-current="page"] {
    border-color: #2563eb;
    background: #2563eb;
    color: #ffffff;

    box-shadow: 0 2px 6px rgba(37, 99, 235, .18);
}


/* DISABLED */

.pagination-wrapper nav span[aria-disabled="true"] {
    background: #f9fafb;
    color: #c4c9d0;
    border-color: #edf0f2;

    cursor: not-allowed;
}


/* ARROW */

.pagination-wrapper nav a[rel="prev"],
.pagination-wrapper nav a[rel="next"] {
    font-size: 15px;
}


/* DOTS */

.pagination-wrapper nav span:not([aria-current]):not([aria-disabled]) {
    min-width: 30px;

    border-color: transparent;
    background: transparent;
}

</style>

<div class="specialties-page">

    <div class="page-header">
        <div>
            <h1>Specialties</h1>
            <p>Manage medical specialties and department descriptions</p>
        </div>
        <div>
            <a href="{{ route('specialties.create') }}" class="btn btn-primary">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Specialty
            </a>
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="specialty-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Specialty Name</th>
                        <th style="width: 58%;">Description</th>
                        <th style="width: 12%; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($specialties as $specialty)
                        <tr>
                            <td>
                                <div class="specialty-title">{{ $specialty->name }}</div>
                            </td>
                            <td>
                                <div class="specialty-desc">
                                    @if($specialty->description)
                                        {{ $specialty->description }}
                                    @else
                                        <span class="text-muted-empty">No description available</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('specialties.show', $specialty) }}" class="btn-action btn-show" title="View Details">
                                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('specialties.edit', $specialty) }}" class="btn-action" title="Edit">
                                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    
                                    <form action="{{ route('specialties.destroy', $specialty) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this specialty?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Delete">
                                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-state">
                                No specialties found in the database.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

         @if(method_exists($specialties, 'links'))

            <div class="pagination-container">

                <div class="pagination-wrapper">

                    {{ $specialties->withQueryString()->links() }}

                </div>
            </div>
        @endif
    </div>

</div>
@endsection
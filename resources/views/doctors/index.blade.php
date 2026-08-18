
@extends('layouts.app')

@section('title', 'Doctors')
@section('page-title', 'Doctors')

@section('content')

<style>

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
    }

    .page-description {
        color: #64748b;
        font-size: 14px;
        margin-top: 5px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        height: 44px;
        padding: 0 20px;

        background: #13adb5;
        color: white;

        border-radius: 8px;
        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: 0.2s;
    }

    .btn-primary:hover {
        background: #0d969d;
    }

    /* ================= CARD ================= */

    .doctors-card {
        background: white;

        border: 1px solid #dceeee;
        border-radius: 12px;

        box-shadow:
            0 5px 20px rgba(0, 100, 100, 0.06);

        overflow: hidden;
    }

    /* ================= TOOLBAR ================= */

    .doctors-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 20px;

        border-bottom: 1px solid #edf4f4;
    }

    .search-form {
        display: flex;
        width: 100%;
        max-width: 500px;
        gap: 8px;
    }

    .search-input {
        flex: 1;

        height: 42px;

        padding: 0 14px;

        border: 1px solid #cbdede;
        border-radius: 8px;

        outline: none;

        font-size: 14px;
        color: #1f2937;
    }

    .search-input:focus {
        border-color: #15b5bc;

        box-shadow:
            0 0 0 3px rgba(21, 181, 188, 0.1);
    }

    .search-btn {
        height: 42px;

        padding: 0 18px;

        border: none;
        border-radius: 8px;

        background: #e5f8f8;
        color: #0d969d;

        font-weight: 600;

        cursor: pointer;
    }

    .search-btn:hover {
        background: #d5f2f2;
    }

    /* ================= TABLE ================= */

    .table-wrapper {
        overflow-x: auto;
    }

    .doctors-table {
        width: 100%;

        border-collapse: collapse;

        min-width: 900px;
    }

    .doctors-table thead {
        background: #f8fcfc;
    }

    .doctors-table th {
        text-align: left;

        padding: 15px 20px;

        color: #64748b;

        font-size: 12px;
        font-weight: 600;

        text-transform: uppercase;
        letter-spacing: 0.4px;

        border-bottom: 1px solid #e5eeee;
    }

    .doctors-table td {
        padding: 17px 20px;

        border-bottom: 1px solid #edf4f4;

        color: #475569;

        font-size: 14px;
    }

    .doctors-table tbody tr:hover {
        background: #fbfefe;
    }

    .doctors-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ================= DOCTORS ================= */

    .doctor-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .doctor-avatar {
        width: 40px;
        height: 40px;

        border-radius: 50%;

        background: #e0f7f7;
        color: #0d969d;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 14px;
        font-weight: bold;
    }

    .doctor-name {
        color: #1f2937;

        font-weight: 600;

        margin-bottom: 3px;
    }

    .doctor-code {
        color: #94a3b8;

        font-size: 12px;
    }
    .remove-btn {
        background: #fee2e2;
        color: #dc2626;
    }

    .remove-btn:hover {
        background: #fecaca;
    }

    /* ================= ACTIONS ================= */

    .actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .action-btn {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        height: 34px;

        padding: 0 11px;

        border-radius: 6px;

        text-decoration: none;

        font-size: 12px;
        font-weight: 600;

        transition: 0.2s;
    }
    .trash-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 12px 18px;

        border: 1px solid #e5e7eb;
        border-radius: 10px;

        background: #ffffff;
        color: #4b5563;

        font-size: 14px;
        font-weight: 600;

        text-decoration: none;

        transition: all 0.2s ease;
    }

    .trash-btn:hover {
        background: #f9fafb;
        color: #111827;
        border-color: #d1d5db;
    }


    .view-btn {
        background: #e8f8f8;
        color: #0d969d;
    }

    .view-btn:hover {
        background: #d7f2f2;
    }

    .edit-btn {
        background: #f1f5f9;
        color: #475569;
    }

    .edit-btn:hover {
        background: #e2e8f0;
    }

    /* ================= EMPTY ================= */

    .empty-state {
        padding: 70px 20px;

        text-align: center;

        color: #94a3b8;
    }

    .empty-icon {
        font-size: 40px;

        margin-bottom: 12px;
    }

    .empty-state h3 {
        color: #475569;

        font-size: 17px;

        margin-bottom: 6px;
    }

    .empty-state p {
        font-size: 13px;
    }

    /* ================= PAGINATION ================= */

    .pagination {
        padding: 18px 20px;

        border-top: 1px solid #edf4f4;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 700px) {

        .page-header {
            flex-direction: column;

            align-items: flex-start;

            gap: 15px;
        }

        .doctors-toolbar {
            padding: 15px;
        }

        .search-form {
            max-width: none;
        }

    }

</style>


<!-- ================= PAGE HEADER ================= -->

<div class="page-header">

    <div>
        <h1>
            Doctors
        </h1>

        <div class="page-description">
            Manage doctor information and medical records.
        </div>

    </div>


    @if(auth()->user()->hasPermission('DOCTORS.CREATE'))

        <a
            href="{{ route('doctors.create') }}"
            class="btn-primary"
        >

            <span>+</span>

            Add Doctor

        </a>
        

    @endif


</div>



<!-- ================= DOCTORS CARD ================= -->

<div class="doctors-card">


    <!-- Toolbar -->

    <div class="doctors-toolbar">

        <form
            method="GET"
            action="{{ route('doctors.index') }}"
            class="search-form"
        >

            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                class="search-input"
                placeholder="Search by name, specialty or doctor code..."
            >

            <button
                type="submit"
                class="search-btn"
            >
                Search
            </button>
        </form>
    </div>

    @if($doctors->count())
        <!-- ================= TABLE ================= -->
        <div class="table-wrapper">
            <table class="doctors-table">
                <thead>
                    <tr>
                        <th>
                            Doctor
                        </th>
                        <th>
                            Specialty
                        </th>
                        <th>
                            License Number
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($doctors as $doctor)
                        <tr>
                            <td>
                                <div class="doctor-info">
                                    <div class="doctor-avatar">
                                        {{ strtoupper(
                                            substr($doctor->user->name, 6, 8)
                                        ) }}
                                    </div>
                                    <div>
                                        <div class="doctor-name">
                                            {{ $doctor->user->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $doctor->specialty->name }}
                            </td>

                            <td>
                                {{ $doctor->license_number }}
                            </td>

                            <!-- Actions -->
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ================= PAGINATION ================= -->

        @if(method_exists($doctors, 'links'))
            <div class="pagination">
                {{ $doctors->withQueryString()->links() }}
            </div>
        @endif
    @else
        <!-- ================= EMPTY STATE ================= -->
        <div class="empty-state">
            <div class="empty-icon">
                ♙
            </div>
            <h3>
                No doctors found
            </h3>
            <p>
                There are no doctors matching your search.
            </p>
        </div>
    @endif
</div>
@endsection


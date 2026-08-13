
@extends('layouts.app')

@section('title', 'Examinations')
@section('page-title', 'Examinations')

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

    .patients-card {
        background: white;

        border: 1px solid #dceeee;
        border-radius: 12px;

        box-shadow:
            0 5px 20px rgba(0, 100, 100, 0.06);

        overflow: hidden;
    }

    /* ================= TOOLBAR ================= */

    .patients-toolbar {
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

    .patients-table {
        width: 100%;

        border-collapse: collapse;

        min-width: 900px;
    }

    .patients-table thead {
        background: #f8fcfc;
    }

    .patients-table th {
        text-align: left;

        padding: 15px 20px;

        color: #64748b;

        font-size: 12px;
        font-weight: 600;

        text-transform: uppercase;
        letter-spacing: 0.4px;

        border-bottom: 1px solid #e5eeee;
    }

    .patients-table td {
        padding: 17px 20px;

        border-bottom: 1px solid #edf4f4;

        color: #475569;

        font-size: 14px;
    }

    .patients-table tbody tr:hover {
        background: #fbfefe;
    }

    .patients-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ================= PATIENT ================= */

    .patient-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .patient-avatar {
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

    .patient-name {
        color: #1f2937;

        font-weight: 600;

        margin-bottom: 3px;
    }

    .patient-code {
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
    .filter-card {
        background: white;

        border: 1px solid #dceeee;

        border-radius: 12px;

        padding: 18px;

        margin-bottom: 25px;

        box-shadow:
            0 5px 20px rgba(0, 100, 100, 0.05);
    }

    .filter-form {
        display: grid;

        grid-template-columns: 1.5fr 1fr 1fr auto;

        gap: 12px;
    }

    .filter-input,
    .filter-select {

        width: 100%;

        height: 42px;

        padding: 0 12px;

        border: 1px solid #cbdede;

        border-radius: 8px;

        background: white;

        color: #374151;

        font-size: 13px;

        outline: none;
    }

    .filter-input:focus,
    .filter-select:focus {

        border-color: #15b5bc;

        box-shadow:
            0 0 0 3px rgba(21, 181, 188, 0.1);
    }

    .filter-btn {

        height: 42px;
        padding: 0 18px;
        border: none;
        border-radius: 8px;
        background: #e0f7f7;
        color: #0d969d;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .filter-btn:hover {
        background: #cceeee;
    }

    /* ================= PAGINATION ================= */

    /* =========================================
   PAGINATION
========================================= */

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


/* MOBILE */

@media (max-width: 600px) {

    .pagination-wrapper {
        margin-top: 20px;
    }

    .pagination-wrapper nav ul {
        gap: 4px;
    }

    .pagination-wrapper nav a,
    .pagination-wrapper nav span {
        min-width: 34px;
        height: 34px;

        padding: 0 8px;

        font-size: 12px;
    }

}

    /* ================= RESPONSIVE ================= */

    @media (max-width: 700px) {

        .page-header {
            flex-direction: column;

            align-items: flex-start;

            gap: 15px;
        }

        .patients-toolbar {
            padding: 15px;
        }

        .search-form {
            max-width: none;
        }

    }
    @media (max-width: 650px) {
        .filter-form {

            grid-template-columns: 1fr;
        }
    }

</style>


<!-- ================= PAGE HEADER ================= -->

<div class="page-header">

    <div>
        <h1>
            Examination
        </h1>

        <div class="page-description">
            Manage and create examination.
        </div>

    </div>




</div>



<!-- ================= PATIENTS CARD ================= -->

<div class="patients-card">


    <!-- Toolbar -->

    <div class="filter-card">

        <form
            method="GET"
            action="{{ route('examinations.index') }}"
            class="filter-form"
        >

            <input
                type="text"
                name="full_name"
                value="{{ request('full_name') }}"
                class="filter-input"
                placeholder="Search patient..."
            >

            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="filter-input"
            >


            <button
                type="submit"
                class="filter-btn"
            >
                Filter
            </button>

        </form>

    </div>



    @if($examinations->count())


        <!-- ================= TABLE ================= -->

        <div class="table-wrapper">

            <table class="patients-table">

                <thead>

                    <tr>

                        <th>
                            Patient
                        </th>

                        <th>
                            Doctor
                        </th>

                        <th>
                            Examinated at
                        </th>

                        <th>
                            Diagnosis
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($examinations as $examination)

                        <tr>


                            <!-- Patient -->

                            <td>

                                <div class="patient-info">

                                    <div class="patient-avatar">

                                        {{ strtoupper(
                                            substr($examination->
                                            appointment->patient->full_name, 0, 1)
                                        ) }}

                                    </div>


                                    <div>

                                        <div class="patient-name">

                                            {{ $examination->
                                            appointment->patient->full_name }}

                                        </div>

                                        <div class="patient-code">

                                            {{ $examination->
                                            appointment->patient->code }}

                                        </div>

                                    </div>

                                </div>

                            </td>



                            <!-- Doctor -->

                            <td>

                                {{ ucfirst($examination->
                                            appointment->doctor
                                            ->user->name) }}

                            </td>



                            <!-- Examinated at -->

                            <td>

                                {{ $examination->examinated_at
                                    ? \Carbon\Carbon::parse(
                                        $examination->examinated_at
                                    )->format('m/d/Y')
                                    : '-'
                                }}

                            </td>
                            <!-- Diagnosis -->
                            <td>
                                {{ $examination->diagnosis }}
                            </td>
                            <!-- Actions -->
                            <td>
                                <div class="actions">
                                    @if(
                                        auth()->user()->hasPermission(
                                            'EXAMINATIONS.FINDONE'
                                        )
                                    )
                                        <a
                                            href="{{ route(
                                                'examinations.show',
                                                $examination
                                            ) }}"
                                            class="action-btn view-btn"
                                        >
                                            View
                                        </a>

                                    @endif
                                    @if(
                                        auth()->user()->hasPermission(
                                            'EXAMINATIONS.UPDATE'
                                        )
                                    )
                                        <a
                                            href="{{ route(
                                                'examinations.edit',
                                                $examination
                                            ) }}"
                                            class="action-btn edit-btn"
                                        >
                                            Edit
                                        </a>

                                    @endif
                                    @if(
                                        auth()->user()->hasPermission(
                                            'EXAMINATIONS.DELETE'
                                        )
                                    )
                                        <form
                                            action="{{ route('examinations.destroy', $patient) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Move this patient to trash?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn remove-btn"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- ================= PAGINATION ================= -->

        @if(method_exists($examinations, 'links'))

            <div class="pagination-container">


                <div class="pagination-wrapper">

                    {{ $examinations->withQueryString()->links() }}

                </div>

            </div>

        @endif


        @else


        <!-- ================= EMPTY STATE ================= -->

        <div class="empty-state">

            <div class="empty-icon">
                ♙
            </div>

            <h3>
                No examinations found
            </h3>

            <p>
                There are no examinations matching your search.
            </p>

        </div>


    @endif


</div>

@endsection


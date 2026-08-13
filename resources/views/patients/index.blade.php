
@extends('layouts.app')

@section('title', 'Patients')
@section('page-title', 'Patients')

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

    /* ================= PAGINATION ================= */

    .pagination {
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

</style>


<!-- ================= PAGE HEADER ================= -->

<div class="page-header">

    <div>

        <div class="page-description">
            Manage patient information and medical records.
        </div>

    </div>


    @if(auth()->user()->hasPermission('PATIENTS.CREATE'))

        <a
            href="{{ route('patients.create') }}"
            class="btn-primary"
        >

            <span>+</span>

            Add Patient

        </a>
        

    @endif


</div>



<!-- ================= PATIENTS CARD ================= -->

<div class="patients-card">


    <!-- Toolbar -->

    <div class="patients-toolbar">

        <form
            method="GET"
            action="{{ route('patients.index') }}"
            class="search-form"
        >

            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                class="search-input"
                placeholder="Search by name, phone or patient code..."
            >

            <button
                type="submit"
                class="search-btn"
            >
                Search
            </button>

        </form>

    </div>



    @if($patients->count())


        <!-- ================= TABLE ================= -->

        <div class="table-wrapper">

            <table class="patients-table">

                <thead>

                    <tr>

                        <th>
                            Patient
                        </th>

                        <th>
                            Gender
                        </th>

                        <th>
                            Date of Birth
                        </th>

                        <th>
                            Phone
                        </th>



                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($patients as $patient)

                        <tr>


                            <!-- Patient -->

                            <td>

                                <div class="patient-info">

                                    <div class="patient-avatar">

                                        {{ strtoupper(
                                            substr($patient->full_name, 0, 1)
                                        ) }}

                                    </div>


                                    <div>

                                        <div class="patient-name">

                                            {{ $patient->full_name }}

                                        </div>

                                        <div class="patient-code">

                                            {{ $patient->code }}

                                        </div>

                                    </div>

                                </div>

                            </td>



                            <!-- Gender -->

                            <td>

                                {{ ucfirst($patient->gender) }}

                            </td>



                            <!-- Date of Birth -->

                            <td>

                                {{ $patient->date_of_birth
                                    ? \Carbon\Carbon::parse(
                                        $patient->date_of_birth
                                    )->format('d/m/Y')
                                    : '-'
                                }}

                            </td>



                            <!-- Phone -->

                            <td>

                                {{ $patient->phone }}

                            </td>


                            <!-- Actions -->

                            <td>

                                <div class="actions">


                                    @if(
                                        auth()->user()->hasPermission(
                                            'PATIENTS.FINDONE'
                                        )
                                    )

                                        <a
                                            href="{{ route(
                                                'patients.show',
                                                $patient
                                            ) }}"
                                            class="action-btn view-btn"
                                        >
                                            View
                                        </a>

                                    @endif


                                    @if(
                                        auth()->user()->hasPermission(
                                            'PATIENTS.UPDATE'
                                        )
                                    )

                                        <a
                                            href="{{ route(
                                                'patients.edit',
                                                $patient
                                            ) }}"
                                            class="action-btn edit-btn"
                                        >
                                            Edit
                                        </a>

                                    @endif
                                    @if(
                                        auth()->user()->hasPermission(
                                            'PATIENTS.DELETE'
                                        )
                                    )
                                        <form
                                            action="{{ route('patients.destroy', $patient) }}"
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

        @if(method_exists($patients, 'links'))

            <div class="pagination-container">

                <div class="pagination-wrapper">

                    {{ $patients->withQueryString()->links() }}

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
                No patients found
            </h3>
            <p>
                There are no patients matching your search.
            </p>
        </div>
    @endif


</div>

@endsection


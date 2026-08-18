
@extends('layouts.app')

@section('title', 'Invoices')
@section('page-title', 'Invoices')

@section('content')

<style>

    .invoices-page {
        width: 100%;
    }

    /* ================= HEADER ================= */

    .invoices-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 25px;
    }

    .invoices-header h1 {
        font-size: 27px;
        color: #111827;
        margin-bottom: 5px;
    }

    .invoices-description {
        color: #64748b;
        font-size: 14px;
    }

    .create-btn {
        height: 43px;

        padding: 0 18px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #13adb5;
        color: white;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: 0.2s;
    }

    .create-btn:hover {
        background: #0d969d;
    }


    /* ================= FILTER ================= */

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


    /* ================= APPOINTMENT GRID ================= */

    .invoice-grid {

        display: grid;

        grid-template-columns:
            repeat(auto-fill, minmax(270px, 1fr));

        gap: 20px;
    }


    /* ================= APPOINTMENT CARD ================= */

    .invoice-card {

        aspect-ratio: 1 / 1;

        background: white;

        border: 1px solid #dceeee;

        border-radius: 14px;

        padding: 20px;

        display: flex;

        flex-direction: column;

        box-shadow:
            0 5px 20px rgba(0, 100, 100, 0.06);

        transition:
            transform 0.2s,
            box-shadow 0.2s;
    }

    .invoice-card:hover {

        transform: translateY(-3px);

        box-shadow:
            0 10px 28px rgba(0, 100, 100, 0.11);
    }


    /* ================= CARD TOP ================= */

    .card-top {

        display: flex;

        align-items: center;

        justify-content: space-between;

        margin-bottom: 18px;
    }

    .invoice-icon {

        width: 43px;
        height: 43px;

        border-radius: 10px;

        background: #e0f7f7;

        color: #0d969d;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 21px;
    }


    /* ================= STATUS ================= */

    .status-badge {

        padding: 6px 10px;

        border-radius: 20px;

        font-size: 11px;

        font-weight: 700;

        text-transform: capitalize;
    }

    .status-paid {

        background: #dcfce7;

        color: #15803d;
    }

    .status-cancelled {

        background: #fee2e2;

        color: #dc2626;
    }

    .status-unpaid {

        background: #e0e7ff;

        color: #4338ca;
    }


    /* ================= DATE ================= */

    .invoice-date {

        color: #13adb5;

        font-size: 13px;

        font-weight: 700;

        margin-bottom: 5px;
    }

    .invoice-time {

        color: #111827;

        font-size: 22px;

        font-weight: 700;

        margin-bottom: 18px;
    }


    /* ================= PEOPLE ================= */

    .person {

        display: flex;

        align-items: center;

        gap: 10px;

        margin-bottom: 11px;
    }

    .person-avatar {

        width: 34px;
        height: 34px;

        flex-shrink: 0;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #eefafa;

        color: #0d969d;

        font-size: 12px;

        font-weight: 700;
    }

    .person-info {

        min-width: 0;
    }

    .person-label {

        color: #94a3b8;

        font-size: 10px;

        margin-bottom: 2px;

        text-transform: uppercase;

        letter-spacing: 0.3px;
    }

    .person-name {

        color: #374151;

        font-size: 13px;

        font-weight: 600;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    /* ================= REASON ================= */

    .invoice-reason {

        margin-top: auto;

        padding-top: 12px;

        border-top: 1px solid #edf4f4;

        color: #64748b;

        font-size: 12px;

        line-height: 1.4;

        display: -webkit-box;

        -webkit-line-clamp: 2;

        -webkit-box-orient: vertical;

        overflow: hidden;
    }


    /* ================= CARD FOOTER ================= */

    .card-footer {

        display: flex;

        justify-content: flex-end;

        gap: 7px;

        margin-top: 12px;
    }

    .action-btn {

        height: 32px;

        padding: 0 11px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        border-radius: 7px;

        text-decoration: none;

        font-size: 11px;

        font-weight: 600;
    }

    .view-btn {

        background: #effafa;

        color: #0d969d;
    }

    .view-btn:hover {
        background: #dff5f5;
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

        grid-column: 1 / -1;

        background: white;

        border: 1px solid #dceeee;

        border-radius: 14px;

        padding: 60px 20px;

        text-align: center;
    }

    .empty-icon {

        width: 60px;
        height: 60px;

        margin: 0 auto 15px;

        border-radius: 50%;

        background: #e0f7f7;

        color: #13adb5;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 26px;
    }

    .empty-state h3 {

        color: #374151;

        font-size: 17px;

        margin-bottom: 7px;
    }

    .empty-state p {

        color: #94a3b8;

        font-size: 13px;

        margin-bottom: 18px;
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

    @media (max-width: 900px) {

        .filter-form {

            grid-template-columns: 1fr 1fr;
        }

    }


    @media (max-width: 650px) {

        .invoices-header {

            flex-direction: column;

            align-items: flex-start;

            gap: 15px;
        }

        .create-btn {
            width: 100%;
        }

        .filter-form {

            grid-template-columns: 1fr;
        }

        .invoice-grid {

            grid-template-columns: 1fr;
        }

        .invoice-card {

            aspect-ratio: auto;

            min-height: 330px;
        }

    }

</style>


<div class="invoices-page">


    <!-- ================= HEADER ================= -->

    <div class="invoices-header">

        <div>

            <h1>
                Invoices
            </h1>

            <div class="invoices-description">
                Manage invoices and invoice details.
            </div>

        </div>


    </div>


    <!-- ================= FILTER ================= -->

    <div class="filter-card">

        <form
            method="GET"
            action="{{ route('invoices.index') }}"
            class="filter-form"
        >

            <input
                type="text"
                name="full_name"
                value="{{ request('full_name') }}"
                class="filter-input"
                placeholder="Search patient..."
            >


            <select
                name="status"
                class="filter-select"
            >

                <option value="">
                    All Status
                </option>

                <option
                    value="unpaid"
                    {{ request('status') === 'unpaid'
                        ? 'selected'
                        : ''
                    }}
                >
                    Unpaid
                </option>

                <option
                    value="paid"
                    {{ request('status') === 'paid'
                        ? 'selected'
                        : ''
                    }}
                >
                    Paid
                </option>

                <option
                    value="cancelled"
                    {{ request('status') === 'cancelled'
                        ? 'selected'
                        : ''
                    }}
                >
                    Cancelled
                </option>

            </select>


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



    <!-- ================= INVOICE CARDS ================= -->

    <div class="invoice-grid">
        @forelse($invoices as $invoice)
            <div class="invoice-card">

                <!-- CARD TOP -->

                <div class="card-top">

                    <div class="invoice-icon">
                        $
                    </div>

                    <span
                        class="status-badge status-{{ $invoice->status }}"
                    >
                        {{ $invoice->status }}
                    </span>

                </div>

                <!-- DATE -->
                <div class="invoice-date">

                    {{ \Carbon\Carbon::parse(
                        $invoice->issued_at
                    )->format('D, d M Y') }}
                </div>

                <div class="invoice-time">

                    {{ \Carbon\Carbon::parse(
                        $invoice->issued_at
                    )->format('H:i') }}
                </div>
                <!-- PATIENT -->
                <div class="person">
                    <div class="person-avatar">
                        {{ strtoupper(
                            substr(
                                $invoice->examination
                            ->appointment->patient->full_name,0,1
                            )
                        ) }}
                    </div>
                    <div class="person-info">
                        <div class="person-label">
                            Patient
                        </div>
                        <div class="person-name">

                            {{ $invoice->examination
                            ->appointment->patient->full_name }}

                        </div>
                    </div>
                </div>

                <!-- DOCTOR -->

                <div class="person">

                    <div class="person-avatar">

                        {{ strtoupper(
                            substr(
                                $invoice->examination
                            ->appointment->doctor->user->name,
                                0,
                                1
                            )
                        ) }}

                    </div>


                    <div class="person-info">

                        <div class="person-label">
                            Doctor
                        </div>

                        <div class="person-name">

                            Dr. {{ $invoice->examination
                            ->appointment->doctor->user->name }}

                        </div>

                    </div>

                </div>


                <!-- REASON -->
                @if($invoice->total)
                    <div class="invoice-reason">
                        Total: {{ $invoice->total }}

                    </div>

                @endif
                <!-- ACTIONS -->

                <div class="card-footer">

                    @if(
                        auth()->user()->hasPermission(
                            'INVOICES.FINDONE'
                        )
                    )
                        <a
                            href="{{ route(
                                'invoices.show',
                                $invoice
                            ) }}"
                            class="action-btn view-btn"
                        >
                            View
                        </a>
                    @endif
                </div>
            </div>
        @empty


            <div class="empty-state">

                <div class="empty-icon">
                    ♡
                </div>

                <h3>
                    No invoices found
                </h3>

                <p>
                    There are currently no invoices matching your criteria.
                </p>

            </div>

        @endforelse


    </div>


    <!-- ================= PAGINATION ================= -->
    @if(method_exists($invoices, 'links'))

            <div class="pagination-container">

                <div class="pagination-wrapper">

                    {{ $invoices->withQueryString()->links() }}

                </div>
            </div>
        @endif


</div>

@endsection

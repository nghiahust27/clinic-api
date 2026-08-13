@extends('layouts.app')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')

<style>

    .users-page {
        padding-bottom: 30px;
    }

    /* ================= HEADER ================= */

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .page-title h1 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #243447;
    }

    .page-title p {
        margin: 6px 0 0;
        font-size: 13px;
        color: #8a9aaa;
    }

    .create-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 11px 18px;

        background: #1687a7;
        color: white;

        border-radius: 8px;

        text-decoration: none;

        font-size: 13px;
        font-weight: 600;

        transition: 0.2s;
    }

    .create-btn:hover {
        background: #11738e;
    }

    /* ================= ALERT ================= */

    .alert {
        padding: 13px 16px;
        margin-bottom: 20px;

        border-radius: 8px;

        background: #e9f8f5;
        border: 1px solid #c8eee7;

        color: #247d70;

        font-size: 13px;
    }

    /* ================= CARD ================= */

    .users-card {
        background: white;

        border: 1px solid #e5edf2;
        border-radius: 12px;

        overflow: hidden;

        box-shadow: 0 3px 12px rgba(30, 70, 90, 0.04);
    }

    /* ================= TOOLBAR ================= */

    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 18px 20px;

        border-bottom: 1px solid #edf2f5;
    }

    .toolbar-title {
        font-size: 14px;
        font-weight: 700;
        color: #34495e;
    }

    .toolbar-subtitle {
        margin-top: 4px;

        font-size: 11px;
        color: #94a3b8;
    }

    .search-form {
        display: flex;
        gap: 8px;
    }

    .search-input {
        width: 260px;
        height: 38px;

        padding: 0 12px;

        border: 1px solid #dce6ec;
        border-radius: 7px;

        outline: none;

        font-size: 12px;
        color: #34495e;
    }

    .search-input:focus {
        border-color: #1687a7;
    }

    .search-btn {
        height: 38px;

        padding: 0 15px;

        border: none;
        border-radius: 7px;

        background: #edf7f9;
        color: #1687a7;

        font-size: 12px;
        font-weight: 600;

        cursor: pointer;
    }

    .search-btn:hover {
        background: #dff1f4;
    }

    /* ================= TABLE ================= */

    .table-wrapper {
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
    }

    .users-table th {
        padding: 13px 20px;

        background: #f8fafb;

        color: #91a0ae;

        text-align: left;

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .users-table td {
        padding: 16px 20px;

        border-top: 1px solid #edf2f5;

        font-size: 12px;
        color: #526273;
    }

    .users-table tbody tr:hover {
        background: #fbfdfe;
    }

    /* ================= USER ================= */

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #e7f5f7;
        color: #1687a7;

        font-size: 14px;
        font-weight: 700;
    }

    .user-name {
        color: #2d4053;
        font-weight: 700;
    }

    .user-email {
        margin-top: 3px;
        color: #94a3b8;
        font-size: 11px;
    }

    /* ================= ROLE ================= */

    .role-badge {
        display: inline-block;

        padding: 5px 9px;

        border-radius: 6px;

        background: #eef5f8;
        color: #507083;

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
    }

    /* ================= STATUS ================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        font-size: 11px;
        font-weight: 600;
    }

    .status-dot {
        width: 7px;
        height: 7px;

        border-radius: 50%;
    }

    .status-active {
        color: #248777;
    }

    .status-active .status-dot {
        background: #42b89d;
    }

    .status-inactive {
        color: #a66b6b;
    }

    .status-inactive .status-dot {
        background: #d58b8b;
    }

    /* ================= ACTIONS ================= */

    .actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .action-link {
        color: #1687a7;

        text-decoration: none;

        font-size: 11px;
        font-weight: 600;
    }

    .action-link:hover {
        text-decoration: underline;
    }

    .delete-btn {
        border: none;
        background: none;

        padding: 0;

        color: #c56f6f;

        font-size: 11px;
        font-weight: 600;

        cursor: pointer;
    }

    .delete-btn:hover {
        color: #a94f4f;
    }

    /* ================= EMPTY ================= */

    .empty-state {
        text-align: center;

        padding: 60px 20px;
    }

    .empty-icon {
        width: 50px;
        height: 50px;

        margin: 0 auto 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #edf7f9;
        color: #1687a7;

        font-size: 22px;
    }

    .empty-state h3 {
        margin: 0;

        font-size: 14px;
        color: #526273;
    }

    .empty-state p {
        margin-top: 6px;

        font-size: 11px;
        color: #9aa8b5;
    }

    /* ================= PAGINATION ================= */

    .pagination-wrapper {
        padding: 18px 20px;
        border-top: 1px solid #edf2f5;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 800px) {

        .page-header {
            align-items: flex-start;
            gap: 15px;
        }

        .table-toolbar {
            align-items: flex-start;
            flex-direction: column;
            gap: 15px;
        }

        .search-form {
            width: 100%;
        }

        .search-input {
            flex: 1;
            width: auto;
        }

    }

</style>


<div class="users-page">

    <!-- PAGE HEADER -->

    <div class="page-header">

        <div class="page-title">

            <h1>
                Users
            </h1>

            <p>
                Manage clinic staff accounts and access.
            </p>

        </div>


        @if(auth()->user()->hasPermission('USERS.CREATE'))

            <a
                href="{{ route('users.create') }}"
                class="create-btn"
            >

                <span>
                    +
                </span>

                Create Account

            </a>

        @endif

    </div>


    <!-- SUCCESS MESSAGE -->

    @if(session('success'))

        <div class="alert">

            {{ session('success') }}

        </div>

    @endif


    <!-- USERS CARD -->

    <div class="users-card">


        <!-- TOOLBAR -->

        <div class="table-toolbar">

            <div>

                <div class="toolbar-title">
                    Clinic Staff
                </div>

                <div class="toolbar-subtitle">
                    View and manage registered staff members
                </div>

            </div>


            <form
                method="GET"
                action="{{ route('users.index') }}"
                class="search-form"
            >

                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search users..."
                    class="search-input"
                >

                <button
                    type="submit"
                    class="search-btn"
                >
                    Search
                </button>

            </form>

        </div>


        <!-- TABLE -->

        <div class="table-wrapper">

            <table class="users-table">

                <thead>

                    <tr>

                        <th>
                            User
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)
                        <tr>
                            <!-- USER -->
                            <td>
                                <div class="user-info">
                                    <div class="avatar">

                                        {{ strtoupper(
                                            substr($user->name, 0, 1)
                                        ) }}

                                    </div>


                                    <div>

                                        <div class="user-name">
                                            {{ $user->name }}
                                        </div>

                                        <div class="user-email">
                                            {{ $user->email }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            <!-- ROLE -->

                            <td>

                                <span class="role-badge">

                                    {{ $user->role?->name ?? 'No Role' }}

                                </span>

                            </td>


                            <!-- STATUS -->

                            <td>

                                @if($user->is_active)

                                    <span class="status-badge status-active">

                                        <span class="status-dot"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="status-badge status-inactive">

                                        <span class="status-dot"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            <!-- ACTIONS -->

                            <td>

                                <div class="actions">



                                    @if(auth()->user()->hasPermission('USERS.UPDATE'))

                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="action-link"
                                        >
                                            Edit
                                        </a>

                                    @endif


                                    @if(
                                        auth()->user()->hasPermission('USERS.DELETE')
                                        && $user->id !== auth()->id()
                                    )
                                        @if($user->is_active)
                                            <form
                                                method="POST"
                                                action="{{ route('users.destroy', $user) }}"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="delete-btn"
                                                    onclick="return confirm('Deactivate this account?')"
                                                >
                                                    Deactivate
                                                </button>

                                            </form>
                                        @else
                                            <form
                                                method="POST"
                                                action="{{ route('users.activate', $user) }}"
                                            >

                                                @csrf

                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="status-badge status-active"
                                                    onclick="return confirm('Activate this account?')"
                                                >
                                                    Activate
                                                </button>

                                            </form>
                                        @endif
                                        

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="4">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        ♙
                                    </div>

                                    <h3>
                                        No users found
                                    </h3>

                                    <p>
                                        There are no staff accounts to display.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->

        @if(method_exists($users, 'links'))

            <div class="pagination-wrapper">

                {{ $users->links() }}

            </div>

        @endif


    </div>

</div>

@endsection
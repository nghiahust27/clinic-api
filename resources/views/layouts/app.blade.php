
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Dashboard') - TomaClinic
    </title>


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html,
        body {
            min-height: 100%;
        }


        body {
            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f6fbff;

            color: #172033;
        }


        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }


        a {
            text-decoration: none;
        }


        /* =====================================================
           LAYOUT
        ===================================================== */

        .app-layout {
            min-height: 100vh;

            display: flex;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 250px;

            min-height: 100vh;

            background: #ffffff;

            border-right: 1px solid #e3edf4;

            display: flex;

            flex-direction: column;

            position: fixed;

            left: 0;
            top: 0;
            bottom: 0;

            z-index: 50;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .sidebar-logo {
            height: 78px;

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 0 25px;

            border-bottom: 1px solid #edf2f6;

            color: #123b63;

            font-size: 21px;

            font-weight: 700;
        }


        .sidebar-logo-icon {
            width: 40px;
            height: 40px;

            border-radius: 11px;

            background: #1769aa;

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow:
                0 5px 14px
                rgba(23, 105, 170, 0.20);
        }


        .sidebar-logo-icon::before {
            content: "";

            position: absolute;

            width: 20px;
            height: 6px;

            background: white;

            border-radius: 4px;
        }


        .sidebar-logo-icon::after {
            content: "";

            position: absolute;

            width: 6px;
            height: 20px;

            background: white;

            border-radius: 4px;
        }


        /* =====================================================
           NAVIGATION
        ===================================================== */

        .sidebar-nav {
            flex: 1;

            padding: 22px 14px;

            overflow-y: auto;
        }


        .nav-section {
            margin-bottom: 25px;
        }


        .nav-section-title {
            padding:
                0 12px 9px;

            color: #a0acb8;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 0.8px;

            text-transform: uppercase;
        }


        .nav-item {
            display: flex;

            align-items: center;

            gap: 12px;

            height: 43px;
            padding: 0 12px;
            margin-bottom: 4px;

            border-radius: 8px;

            color: #64748b;

            font-size: 13px;

            font-weight: 600;

            transition:
                background 0.2s ease,
                color 0.2s ease;
        }


        .nav-item:hover {
            background: #f0f7fc;

            color: #1769aa;
        }


        .nav-item.active {
            background: #e9f4fb;

            color: #1769aa;
        }


        .nav-icon {
            width: 20px;
            height: 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: currentColor;

            font-size: 16px;

            flex-shrink: 0;
        }


        /* =====================================================
           SIDEBAR USER
        ===================================================== */

        .sidebar-user {
            padding: 16px;

            border-top: 1px solid #edf2f6;
        }


        .sidebar-user-inner {
            display: flex;

            align-items: center;

            gap: 10px;

            padding: 9px;

            border-radius: 9px;

            background: #f7fafc;
        }


        .user-avatar {
            width: 36px;
            height: 36px;

            border-radius: 9px;

            background: #dceef9;

            color: #1769aa;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 13px;

            font-weight: 700;

            flex-shrink: 0;
        }


        .user-info {
            min-width: 0;

            flex: 1;
        }


        .user-name {
            color: #26384a;

            font-size: 12px;

            font-weight: 700;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .user-role {
            color: #94a3b8;

            font-size: 10px;

            margin-top: 3px;

            text-transform: capitalize;
        }
        .logout-btn {
            border: 1px solid #15b5bc;

            background: white;
            color: #0faab1;

            padding: 10px 20px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 14px;

            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #15b5bc;
            color: white;
        }



        /* =====================================================
           MAIN AREA
        ===================================================== */

        .main-area {
            margin-left: 250px;

            min-height: 100vh;

            flex: 1;

            display: flex;

            flex-direction: column;

            min-width: 0;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 78px;

            background: #ffffff;

            border-bottom: 1px solid #e3edf4;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 34px;

            position: sticky;

            top: 0;

            z-index: 40;
        }


        .page-title {
            color: #172b40;

            font-size: 20px;

            font-weight: 700;
        }


        .page-subtitle {
            color: #94a3b8;

            font-size: 11px;

            margin-top: 4px;
        }


        .topbar-right {
            display: flex;

            align-items: center;

            gap: 20px;
        }


        /* =====================================================
           NOTIFICATION
        ===================================================== */

        .notification {
            width: 36px;
            height: 36px;

            border: 1px solid #e5edf3;

            border-radius: 9px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #64748b;

            position: relative;

            cursor: pointer;
        }


        .notification-dot {
            position: absolute;

            width: 7px;
            height: 7px;

            background: #e76f51;

            border-radius: 50%;

            top: 7px;
            right: 7px;

            border: 1px solid white;
        }


        /* =====================================================
           TOP USER
        ===================================================== */

        .top-user {
            display: flex;

            align-items: center;

            gap: 9px;
        }


        .top-user-avatar {
            width: 37px;
            height: 37px;

            border-radius: 50%;

            background: #1769aa;

            color: white;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 12px;

            font-weight: 700;
        }


        .top-user-info {
            display: flex;

            flex-direction: column;
        }


        .top-user-name {
            color: #334155;

            font-size: 12px;

            font-weight: 700;
        }


        .top-user-role {
            color: #94a3b8;

            font-size: 10px;

            margin-top: 2px;

            text-transform: capitalize;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding: 30px 34px 40px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        .mobile-menu {
            display: none;

            width: 36px;
            height: 36px;

            border: 1px solid #e5edf3;

            border-radius: 8px;

            background: white;

            color: #1769aa;

            cursor: pointer;
        }


        @media (max-width: 900px) {

            .sidebar {
                transform:
                    translateX(-100%);

                transition:
                    transform 0.25s ease;
            }


            .sidebar.open {
                transform:
                    translateX(0);
            }


            .main-area {
                margin-left: 0;
            }


            .mobile-menu {
                display: flex;

                align-items: center;

                justify-content: center;

                margin-right: 12px;
            }


            .topbar {
                padding:
                    0 20px;
            }


            .content {
                padding:
                    25px 20px;
            }

        }


        @media (max-width: 600px) {

            .top-user-info {
                display: none;
            }


            .topbar-right {
                gap: 8px;
            }


            .content {
                padding:
                    20px 15px;
            }

        }

    </style>


    @stack('styles')

</head>


<body>


<div class="app-layout">


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    @include('components.sidebar')


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <div class="main-area">


        <!-- TOPBAR -->

        <header class="topbar">


            <div style="display:flex; align-items:center;">

                <button
                    class="mobile-menu"
                    onclick="toggleSidebar()"
                    type="button"
                >
                    ☰
                </button>


                <div>

                    <div class="page-title">
                        @yield('page-title', 'Dashboard')
                    </div>

                    <div class="page-subtitle">
                        TomaClinic Management System
                    </div>

                </div>

            </div>


            <div class="topbar-right">


                <div class="notification">

                    🔔

                    <span class="notification-dot"></span>

                </div>


                <div class="top-user">

                    <div class="top-user-avatar">

                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}

                    </div>


                    <div class="top-user-info">

                        <div class="top-user-name">

                            {{ auth()->user()->name ?? 'User' }}

                        </div>


                        <div class="top-user-role">

                            {{ auth()->user()->role->name ?? 'User' }}

                        </div>

                    </div>
                     <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf
                        <button
                            type="submit"
                            class="logout-btn"
                        >
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <!-- PAGE CONTENT -->
        <main class="content">
            @yield('content')
        </main>
    </div>
</div>


<script>

    function toggleSidebar() {

        const sidebar =
            document.querySelector('.sidebar');

        sidebar.classList.toggle('open');

    }

</script>


@stack('scripts')

</body>

</html>


<aside class="sidebar">


    <!-- =====================================================
         LOGO
    ====================================================== -->

    <a
        href="{{ route('dashboard') }}"
        class="sidebar-logo"
    >

        <div class="sidebar-logo-icon"></div>

        TomaClinic

    </a>


    <!-- =====================================================
         NAVIGATION
    ====================================================== -->

    <nav class="sidebar-nav">


        <!-- =================================================
             MAIN
        ================================================== -->

        <div class="nav-section">

            <div class="nav-section-title">
                Main
            </div>


            <a
                href="{{ route('dashboard') }}"
                class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    ▦
                </span>

                Dashboard

            </a>

        </div>


        <!-- =================================================
             CLINIC
        ================================================== -->

        <div class="nav-section">

            <div class="nav-section-title">
                Clinic
            </div>


            {{-- Patients --}}

            @if(auth()->user()->hasPermission('PATIENTS.FINDALL'))

                <a
                    href="{{ route('patients.index') }}"
                    class="nav-item {{ request()->routeIs('patients.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">
                        ♙
                    </span>

                    Patients

                </a>

            @endif


            {{-- Appointments --}}

            @if(auth()->user()->hasPermission('APPOINTMENTS.FINDALL'))

                <a
                    href="{{ route('appointments.index') }}"
                    class="nav-item {{ request()->routeIs('appointments.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">
                        ◫
                    </span>

                    Appointments

                </a>

            @endif


            {{-- Doctors --}}

            @if(auth()->user()->hasPermission('DOCTORS.FINDALL'))

                <a
                    href="{{ route('doctors.index') }}"
                    class="nav-item {{ request()->routeIs('doctors.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">
                        ✚
                    </span>

                    Doctors

                </a>

            @endif


            {{-- Examinations --}}

            @if(auth()->user()->hasPermission('EXAMINATIONS.FINDALL'))

                <a
                    href="{{ route('examinations.index') }}"
                    class="nav-item {{ request()->routeIs('examinations.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">
                        ▤
                    </span>

                    Examinations

                </a>

            @endif

        </div>


        <!-- =================================================
             PHARMACY
        ================================================== -->

        @if(
            auth()->user()->hasPermission('MEDICINES.FINDALL') ||
            auth()->user()->hasPermission('PRESCRIPTIONS.FINDALL')
        )

            <div class="nav-section">

                <div class="nav-section-title">
                    Pharmacy
                </div>


                {{-- Medicines --}}

                @if(auth()->user()->hasPermission('MEDICINES.FINDALL'))

                    <a
                        href="{{ route('medicines.index') }}"
                        class="nav-item {{ request()->routeIs('medicines.*') ? 'active' : '' }}"
                    >

                        <span class="nav-icon">
                            ♧
                        </span>

                        Medicines

                    </a>

                @endif


                

            </div>

        @endif


        <!-- =================================================
             FINANCE
        ================================================== -->

        @if(
            auth()->user()->hasPermission('INVOICES.FINDALL') ||
            auth()->user()->hasPermission('PAYMENTS.FINDALL')
        )

            <div class="nav-section">

                <div class="nav-section-title">
                    Finance
                </div>


                {{-- Invoices --}}

                @if(auth()->user()->hasPermission('INVOICES.FINDALL'))

                    <a>
                        <span class="nav-icon">
                            ▧
                        </span>

                        Invoices

                    </a>

                @endif


                {{-- Payments --}}

                @if(auth()->user()->hasPermission('PAYMENTS.FINDALL'))



                        <span class="nav-icon">
                            $
                        </span>

                        Payments

                    </a>

                @endif

            </div>

        @endif


        <!-- =================================================
             SYSTEM
        ================================================== -->

        @if(
            auth()->user()->hasPermission('USERS.FINDALL') ||
            auth()->user()->hasPermission('ROLES.FINDALL')
        )

            <div class="nav-section">

                <div class="nav-section-title">
                    System
                </div>


                {{-- Users --}}

                @if(auth()->user()->hasPermission('USERS.FINDALL'))

                    <a
                        href="{{ route('users.index') }}"
                    class="nav-item {{ request()
                    ->routeIs('users.*') ? 'active' : '' }}"
                    >

                        <span class="nav-icon">
                            ♙
                        </span>

                        Users

                    </a>

                @endif


                {{-- Roles --}}

                @if(auth()->user()->hasPermission('ROLES.FINDALL'))

                    <a
                        
                    >

                        <span class="nav-icon">
                            ◈
                        </span>

                        Roles

                    </a>

                @endif

            </div>

        @endif


    </nav>


    <!-- =====================================================
         USER
    ====================================================== -->

    <div class="sidebar-user">

        <div class="sidebar-user-inner">


            <div class="user-avatar">

                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}

            </div>


            <div class="user-info">

                <div class="user-name">

                    {{ auth()->user()->name ?? 'User' }}

                </div>


                <div class="user-role">

                    {{ auth()->user()->role->name ?? 'User' }}

                </div>

            </div>


        </div>

    </div>


</aside>

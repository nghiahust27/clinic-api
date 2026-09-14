
<style>

    .nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 8px;
        text-decoration: none;
        color: #4b5563;

        transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), 
                    background-color 0.2s ease, 
                    box-shadow 0.2s ease;
        will-change: transform;
    }

    .nav-item:hover {
        transform: scale(1.03) translateX(3px); 
        background-color: #f3f4f6;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06); 
        color: #1f2937;
    }

    .nav-item:active {
        transform: scale(0.97) translateY(1px); 
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        transition: transform 0.08s ease; 
    }

    .nav-item:hover .nav-icon {
        transform: scale(1.15);
        transition: transform 0.2s ease;
    }

    .nav-icon {
        display: inline-block;
        transition: transform 0.2s ease;
    }
</style>
<aside class="sidebar">

    <!-- LOGO -->
    <a href="{{ route('dashboard') }}" class="sidebar-logo">
        <div class="sidebar-logo-icon"></div>
        TomaClinic
    </a>

    <!-- NAVIGATION -->
    <nav class="sidebar-nav">

        <!-- MAIN -->
        <div class="nav-section">
            <div class="nav-section-title">Main</div>

            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">▦</span>
                Dashboard
            </a>
        </div>

        <!-- CLINIC -->
        <div class="nav-section">
            <div class="nav-section-title">Clinic</div>

            @if(auth()->user()->hasPermission('PATIENTS.FINDALL'))
                <a href="{{ route('patients.index') }}" class="nav-item {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                    <span class="nav-icon">♙</span>
                    Patients
                </a>
            @endif

            @if(auth()->user()->hasPermission('APPOINTMENTS.FINDALL'))
                <a href="{{ route('appointments.index') }}" class="nav-item {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                    <span class="nav-icon">◫</span>
                    Appointments
                </a>
            @endif

            @if(auth()->user()->hasPermission('SPECIALTIES.FINDALL'))
                <a href="{{ route('specialties.index') }}" class="nav-item {{ request()->routeIs('specialties.*') ? 'active' : '' }}">
                    <span class="nav-icon">✚</span>
                    Specialties
                </a>
            @endif

            @if(auth()->user()->hasPermission('DOCTORS.FINDALL'))
                <a href="{{ route('doctors.index') }}" class="nav-item {{ request()->routeIs('doctors.*') ? 'active' : '' }}">
                    <span class="nav-icon">✚</span>
                    Doctors
                </a>
            @endif

            @if(auth()->user()->hasPermission('EXAMINATIONS.FINDALL'))
                <a href="{{ route('examinations.index') }}" class="nav-item {{ request()->routeIs('examinations.*') ? 'active' : '' }}">
                    <span class="nav-icon">▤</span>
                    Examinations
                </a>
            @endif
        </div>

        <!-- PHARMACY -->
        @if(auth()->user()->hasPermission('MEDICINES.FINDALL') || auth()->user()->hasPermission('PRESCRIPTIONS.FINDALL'))
            <div class="nav-section">
                <div class="nav-section-title">Pharmacy</div>

                @if(auth()->user()->hasPermission('MEDICINES.FINDALL'))
                    <a href="{{ route('medicines.index') }}" class="nav-item {{ request()->routeIs('medicines.*') ? 'active' : '' }}">
                        <span class="nav-icon">♧</span>
                        Medicines
                    </a>
                @endif
            </div>
        @endif

        <!-- FINANCE -->
        @if(auth()->user()->hasPermission('INVOICES.FINDALL') || auth()->user()->hasPermission('PAYMENTS.FINDALL'))
            <div class="nav-section">
                <div class="nav-section-title">Finance</div>

                @if(auth()->user()->hasPermission('INVOICES.FINDALL'))
                    <a href="{{ route('invoices.index') }}" class="nav-item {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
                        <span class="nav-icon">▧</span>
                        Invoices
                    </a> {{-- Đã thêm thẻ đóng </a> bị thiếu --}}
                @endif

                @if(auth()->user()->hasPermission('PAYMENTS.FINDALL'))
                    <a href="{{ route('payments.index') }}" class="nav-item {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                        <span class="nav-icon">$</span>
                        Payments
                    </a>
                @endif
            </div>
        @endif

        <!-- SYSTEM -->
        @if(auth()->user()->hasPermission('USERS.FINDALL') || auth()->user()->hasPermission('ROLES.FINDALL'))
            <div class="nav-section">
                <div class="nav-section-title">System</div>

                @if(auth()->user()->hasPermission('USERS.FINDALL'))
                    <a href="{{ route('users.index') }}" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <span class="nav-icon">♙</span>
                        Users
                    </a>
                @endif

                @if(auth()->user()->hasPermission('STATS.SHOW'))
                    <a href="{{ route('stats.index') }}" class="nav-item {{ request()->routeIs('stats.*') ? 'active' : '' }}">
                        <span class="nav-icon">◈</span>
                        Stats
                    </a>
                @endif
            </div>
        @endif

    </nav>

    <!-- USER -->
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
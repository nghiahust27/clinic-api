
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit User - Clinic</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            background: #f0fafa;
            color: #1f2937;
        }

        /* ================= HEADER ================= */

        header {
            height: 80px;
            background: white;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 55px;

            border-bottom: 1px solid #d7eeee;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;

            color: #109fa7;

            font-size: 26px;
            font-weight: bold;
        }

        .logo-icon {
            width: 42px;
            height: 42px;

            background: #15b5bc;

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            font-size: 23px;
            font-weight: bold;
        }

        .back-link {
            text-decoration: none;

            color: #0f9fa7;

            font-size: 15px;
            font-weight: 600;
        }

        .back-link:hover {
            color: #087f86;
        }

        /* ================= PAGE ================= */

        .page {
            max-width: 900px;

            margin: 0 auto;

            padding: 45px 25px 60px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 32px;
            color: #111827;

            margin-bottom: 8px;
        }

        .page-header p {
            color: #64748b;
            font-size: 15px;
        }

        /* ================= CARD ================= */

        .card {
            background: white;

            border-radius: 14px;

            padding: 35px;

            border: 1px solid #d9eeee;

            box-shadow:
                0 8px 25px rgba(0, 100, 100, 0.08);
        }

        /* ================= FORM ================= */

        .form-row {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 25px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;

            margin-bottom: 8px;

            color: #374151;

            font-size: 14px;
            font-weight: 600;
        }

        .form-input {
            width: 100%;

            height: 48px;

            padding: 0 14px;

            border: 1px solid #cbdede;

            border-radius: 8px;

            background: #ffffff;

            color: #1f2937;

            font-size: 15px;

            outline: none;

            transition: 0.2s;
        }

        .form-input:focus {
            border-color: #16b5bc;

            box-shadow:
                0 0 0 3px rgba(22, 181, 188, 0.12);
        }

        .form-input.is-invalid {
            border-color: #ef4444;
        }

        select.form-input {
            cursor: pointer;
        }

        .field-error {
            margin-top: 6px;

            color: #dc2626;

            font-size: 13px;
        }
        .password-section {
            margin-top: 10px;
            padding-top: 25px;
            border-top: 1px solid #e5eeee;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .section-description {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .password-note {
            margin-top: -10px;
            margin-bottom: 25px;
            color: #64748b;
            font-size: 13px;
        }
        /* ================= ROLE INFO ================= */

        .role-note {
            margin-top: -10px;
            margin-bottom: 25px;

            padding: 12px 15px;

            background: #effafa;

            border-left: 4px solid #16b5bc;

            border-radius: 6px;

            color: #557176;

            font-size: 13px;
        }

        /* ================= STATUS ================= */

        .status-section {
            margin-top: 5px;
            margin-bottom: 25px;

            padding-top: 25px;

            border-top: 1px solid #e5eeee;
        }

        .status-title {
            font-size: 14px;
            font-weight: 600;

            color: #374151;

            margin-bottom: 10px;
        }

        .status-badge {
            display: inline-flex;

            align-items: center;
            gap: 7px;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 13px;
            font-weight: 600;
        }

        .status-active {
            background: #e4f8f2;
            color: #15856b;
        }

        .status-inactive {
            background: #f1f5f9;
            color: #64748b;
        }

        .status-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: currentColor;
        }

        /* ================= ACTIONS ================= */

        .actions {
            display: flex;

            justify-content: flex-end;

            gap: 12px;

            padding-top: 10px;
        }

        .btn {
            height: 48px;

            padding: 0 24px;

            border-radius: 8px;

            font-size: 15px;
            font-weight: 600;

            text-decoration: none;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            cursor: pointer;

            transition: 0.2s;
        }

        .btn-secondary {
            background: white;

            color: #64748b;

            border: 1px solid #cbdede;
        }

        .btn-secondary:hover {
            background: #f8ffff;

            color: #374151;
        }

        .btn-primary {
            border: none;

            background: #13adb5;

            color: white;
        }

        .btn-primary:hover {
            background: #0d969d;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 700px) {

            header {
                padding: 0 20px;
            }

            .page {
                padding: 30px 15px;
            }

            .card {
                padding: 25px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .page-header h1 {
                font-size: 27px;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }

        }

    </style>

</head>


<body>


<!-- ================= HEADER ================= -->

<header>

    <div class="logo">

        <div class="logo-icon">
            +
        </div>

        Clinic

    </div>


    <a
        href="{{ route('users.index') }}"
        class="back-link"
    >
        ← Back to Users
    </a>

</header>



<!-- ================= PAGE ================= -->

<main class="page">


    <div class="page-header">

        <h1>
            Edit User
        </h1>

        <p>
            Update account information and role permissions.
        </p>

    </div>



    <!-- ================= FORM CARD ================= -->

    <div class="card">

        <form
            method="POST"
            action="{{ route('users.update', $user) }}"
        >

            @csrf

            @method('PUT')


            <!-- Name + Email -->

            <div class="form-row">


                <!-- Name -->

                <div class="form-group">

                    <label
                        for="name"
                        class="form-label"
                    >
                        Full Name
                    </label>


                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="form-input @error('name') is-invalid @enderror"
                        placeholder="Enter user's full name"
                        required
                    >


                    @error('name')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>



                <!-- Email -->

                <div class="form-group">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Email Address
                    </label>


                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="form-input @error('email') is-invalid @enderror"
                        placeholder="Enter user's email"
                        required
                        autocomplete="email"
                    >


                    @error('email')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


            </div>
            

            <!-- Role -->

            <div class="form-group">

                <label
                    for="role_id"
                    class="form-label"
                >
                    Role
                </label>


                <select
                    id="role_id"
                    name="role_id"
                    class="form-input @error('role_id') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Select a role
                    </option>


                    @foreach($roles as $role)

                        <option
                            value="{{ $role->id }}"
                            {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}
                        >
                            {{ $role->name }}
                        </option>

                    @endforeach

                </select>


                @error('role_id')

                    <div class="field-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>



            <div class="role-note">

                Changing a user's role will change the permissions
                available to that account.

            </div>

            <!-- Password -->

            <div class="password-section">

                <div class="section-title">
                    Change Password
                </div>

                <div class="section-description">
                    Leave these fields empty if you do not want to change the password.
                </div>


                <div class="form-row">

                    <!-- New Password -->

                    <div class="form-group">

                        <label
                            for="password"
                            class="form-label"
                        >
                            New Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-input @error('password') is-invalid @enderror"
                            placeholder="Enter new password"
                            autocomplete="new-password"
                        >

                        @error('password')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- Confirm Password -->

                    <div class="form-group">

                        <label
                            for="password_confirmation"
                            class="form-label"
                        >
                            Confirm New Password
                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-input"
                            placeholder="Confirm new password"
                            autocomplete="new-password"
                        >

                    </div>

                </div>


                <div class="password-note">
                    Use at least 8 characters for the new password.
                </div>

            </div>





            <!-- ================= STATUS ================= -->

            <div class="status-section">

                <div class="status-title">
                    Account Status
                </div>


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

            </div>



            <!-- ================= ACTIONS ================= -->

            <div class="actions">


                <a
                    href="{{ route('users.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Changes
                </button>


            </div>


        </form>

    </div>


</main>


</body>

</html>

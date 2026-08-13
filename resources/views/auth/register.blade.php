
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Register - TomaClinic</title>


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {
            font-family:
                Arial,
                Helvetica,
                sans-serif;

            min-height: 100vh;

            background: #f6fbff;

            color: #172033;

            overflow-x: hidden;
        }


        /* =====================================================
           BACKGROUND
        ===================================================== */

        .background-circle {
            position: fixed;

            border-radius: 50%;

            pointer-events: none;

            z-index: 0;
        }


        .circle-one {
            width: 440px;
            height: 440px;

            background: #e8f5ff;

            top: -190px;
            right: -120px;
        }


        .circle-two {
            width: 350px;
            height: 350px;

            background: #edf9f7;

            bottom: -160px;
            left: -130px;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        header {
            height: 78px;

            background: rgba(255, 255, 255, 0.96);

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 70px;

            border-bottom: 1px solid #e4edf4;

            position: relative;

            z-index: 10;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {
            display: flex;

            align-items: center;

            gap: 12px;

            color: #123b63;

            font-size: 23px;

            font-weight: 700;

            text-decoration: none;
        }


        .logo-icon {
            width: 43px;
            height: 43px;

            background: #1769aa;

            border-radius: 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            position: relative;

            box-shadow:
                0 6px 15px
                rgba(23, 105, 170, 0.22);
        }


        .logo-icon::before {
            content: "";

            position: absolute;

            width: 22px;
            height: 7px;

            background: white;

            border-radius: 4px;
        }


        .logo-icon::after {
            content: "";

            position: absolute;

            width: 7px;
            height: 22px;

            background: white;

            border-radius: 4px;
        }


        /* =====================================================
           HEADER LINK
        ===================================================== */

        .header-link {
            color: #64748b;

            font-size: 14px;

            text-decoration: none;
        }


        .header-link span {
            color: #1769aa;

            font-weight: 700;
        }


        .header-link:hover span {
            color: #12598f;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        main {
            min-height:
                calc(100vh - 78px);

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 45px 20px 55px;

            position: relative;

            z-index: 2;
        }


        /* =====================================================
           REGISTER CARD
        ===================================================== */

        .register-card {
            width: 470px;

            max-width: 100%;

            background: white;

            border: 1px solid #e1ebf3;

            border-radius: 18px;

            padding: 35px 40px 32px;

            box-shadow:
                0 20px 55px
                rgba(30, 70, 100, 0.10);
        }


        /* =====================================================
           CARD HEADER
        ===================================================== */

        .card-header {
            text-align: center;

            margin-bottom: 27px;
        }


        .card-icon {
            width: 56px;
            height: 56px;

            margin: 0 auto 15px;

            background: #e8f4fc;

            color: #1769aa;

            border-radius: 15px;

            display: flex;

            align-items: center;

            justify-content: center;

            position: relative;
        }


        .card-icon::before {
            content: "";

            position: absolute;

            width: 23px;
            height: 7px;

            background: #1769aa;

            border-radius: 4px;
        }


        .card-icon::after {
            content: "";

            position: absolute;

            width: 7px;
            height: 23px;

            background: #1769aa;

            border-radius: 4px;
        }


        .card-header h1 {
            font-size: 27px;

            color: #132238;

            margin-bottom: 8px;
        }


        .card-header p {
            color: #94a3b8;

            font-size: 14px;

            line-height: 1.5;
        }


        /* =====================================================
           ERROR
        ===================================================== */

        .error-box {
            background: #fff3f3;

            border: 1px solid #f5caca;

            color: #c24141;

            border-radius: 8px;

            padding: 11px 13px;

            font-size: 13px;

            margin-bottom: 18px;
        }


        .error-box ul {
            margin-left: 17px;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .form-row {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 14px;
        }


        .form-group {
            margin-bottom: 17px;
        }


        .form-label {
            display: block;

            color: #334155;

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 7px;
        }


        .form-input {
            width: 100%;

            height: 47px;

            border: 1px solid #d8e3eb;

            border-radius: 8px;

            padding: 0 13px;

            font-size: 14px;

            color: #1e293b;

            background: #fbfdff;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }


        .form-input::placeholder {
            color: #a8b4c1;
        }


        .form-input:focus {
            background: white;

            border-color: #5ca8d3;

            box-shadow:
                0 0 0 3px
                rgba(23, 105, 170, 0.09);
        }


        .form-input.is-invalid {
            border-color: #df7777;
        }


        .field-error {
            color: #c24141;

            font-size: 11px;

            margin-top: 5px;
        }


        /* =====================================================
           PASSWORD NOTE
        ===================================================== */

        .password-note {
            color: #94a3b8;

            font-size: 10px;

            margin-top: 6px;

            line-height: 1.4;
        }


        /* =====================================================
           TERMS
        ===================================================== */

        .terms {
            display: flex;

            align-items: flex-start;

            gap: 8px;

            color: #64748b;

            font-size: 11px;

            line-height: 1.5;

            margin:
                3px 0 20px;
        }


        .terms input {
            width: 14px;

            height: 14px;

            margin-top: 1px;

            accent-color: #1769aa;

            flex-shrink: 0;
        }


        .terms a {
            color: #1769aa;

            text-decoration: none;

            font-weight: 600;
        }


        .terms a:hover {
            text-decoration: underline;
        }


        /* =====================================================
           REGISTER BUTTON
        ===================================================== */

        .register-button {
            width: 100%;

            height: 50px;

            border: none;

            border-radius: 8px;

            background: #1769aa;

            color: white;

            font-size: 15px;

            font-weight: 700;

            cursor: pointer;

            transition:
                background 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;

            box-shadow:
                0 7px 18px
                rgba(23, 105, 170, 0.18);
        }


        .register-button:hover {
            background: #12598f;

            transform: translateY(-1px);
        }


        .register-button:active {
            transform: translateY(0);
        }


        /* =====================================================
           LOGIN LINK
        ===================================================== */

        .login-text {
            text-align: center;

            color: #64748b;

            font-size: 13px;

            margin-top: 23px;
        }


        .login-text a {
            color: #1769aa;

            font-weight: 700;

            text-decoration: none;
        }


        .login-text a:hover {
            text-decoration: underline;
        }


        /* =====================================================
           SECURITY
        ===================================================== */

        .security-note {
            display: flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            margin-top: 18px;

            color: #94a3b8;

            font-size: 11px;
        }


        .security-dot {
            width: 7px;
            height: 7px;

            background: #2a9d8f;

            border-radius: 50%;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 600px) {

            header {
                height: 70px;

                padding: 0 18px;
            }


            .logo {
                font-size: 18px;
            }


            .logo-icon {
                width: 36px;
                height: 36px;
            }


            .header-link {
                font-size: 12px;
            }


            main {
                padding:
                    30px 18px;
            }


            .register-card {
                padding:
                    30px 23px 27px;
            }


            .form-row {
                grid-template-columns: 1fr;

                gap: 0;
            }


            .card-header h1 {
                font-size: 24px;
            }

        }

    </style>

</head>


<body>


    <!-- Background -->

    <div class="background-circle circle-one"></div>

    <div class="background-circle circle-two"></div>


    <!-- Header -->

    <header>

        <a
            href="{{ url('/') }}"
            class="logo"
        >

            <div class="logo-icon"></div>

            ClinicCare

        </a>


        <a
            href="{{ route('login') }}"
            class="header-link"
        >
            Already have an account?
            <span>Sign in</span>
        </a>

    </header>


    <!-- Main -->

    <main>


        <div class="register-card">


            <!-- Header -->

            <div class="card-header">

                <div class="card-icon"></div>

                <h1>
                    Create Your Account
                </h1>

                <p>
                    Get started with your clinic management account.
                </p>

            </div>


            <!-- Validation Errors -->

            @if ($errors->any())

                <div class="error-box">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- Register Form -->

            <form
                method="POST"
                action="{{ route('register') }}"
            >

                @csrf


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
                        value="{{ old('name') }}"
                        class="form-input @error('name') is-invalid @enderror"
                        placeholder="Enter your full name"
                        required
                        autofocus
                        autocomplete="name"
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
                        value="{{ old('email') }}"
                        class="form-input @error('email') is-invalid @enderror"
                        placeholder="Enter your email"
                        required
                        autocomplete="email"
                    >


                    @error('email')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- Password -->

                <div class="form-row">


                    <div class="form-group">

                        <label
                            for="password"
                            class="form-label"
                        >
                            Password
                        </label>


                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-input @error('password') is-invalid @enderror"
                            placeholder="Create password"
                            required
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
                            Confirm Password
                        </label>


                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-input"
                            placeholder="Confirm password"
                            required
                            autocomplete="new-password"
                        >

                    </div>


                </div>


                <div class="password-note">

                    Use at least 8 characters for your password.

                </div>


                <!-- Terms -->

                <label class="terms">

                    <input
                        type="checkbox"
                        name="terms"
                        required
                    >


                    <span>

                        I agree to the
                        <a href="#">
                            Terms of Service
                        </a>
                        and
                        <a href="#">
                            Privacy Policy
                        </a>.

                    </span>

                </label>


                <!-- Submit -->

                <button
                    type="submit"
                    class="register-button"
                >
                    Create Account
                </button>


            </form>


            <!-- Login -->

            <div class="login-text">

                Already have an account?

                <a href="{{ route('login') }}">
                    Sign in
                </a>

            </div>


            <!-- Security -->

            <div class="security-note">

                <span class="security-dot"></span>

                Secure clinic management platform

            </div>


        </div>


    </main>


</body>

</html>

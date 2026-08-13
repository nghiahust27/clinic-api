
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - TomaClinic</title>


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

        /*=====================================================
           BACKGROUND
        ===================================================== */

        .background-circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .circle-one {
            width: 420px;
            height: 420px;
            background: #e8f5ff;
            top: -180px;
            right: -100px;
        }

        .circle-two {
            width: 330px;
            height: 330px;
            background: #edf9f7;
            bottom: -150px;
            left: -120px;
        }

        /* ====================================================
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
            letter-spacing: -0.3px;
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
                0 6px 15px rgba(23, 105, 170, 0.22);
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

            padding: 50px 20px;

            position: relative;

            z-index: 2;
        }


        /* =====================================================
           LOGIN CARD
        ===================================================== */

        .login-card {
            width: 430px;

            max-width: 100%;

            background: white;

            border: 1px solid #e1ebf3;

            border-radius: 18px;

            padding: 38px 40px 35px;

            box-shadow:
                0 20px 55px
                rgba(30, 70, 100, 0.10);
        }


        /* =====================================================
           CARD HEADER
        ===================================================== */

        .card-header {
            text-align: center;

            margin-bottom: 30px;
        }


        .card-icon {
            width: 58px;
            height: 58px;

            margin: 0 auto 17px;

            background: #e8f4fc;

            color: #1769aa;

            border-radius: 15px;

            display: flex;

            align-items: center;

            justify-content: center;

            position: relative;
        }


        /*
            Small medical cross
        */

        .card-icon::before {
            content: "";

            position: absolute;

            width: 24px;
            height: 8px;

            background: #1769aa;

            border-radius: 4px;
        }


        .card-icon::after {
            content: "";

            position: absolute;

            width: 8px;
            height: 24px;

            background: #1769aa;

            border-radius: 4px;
        }


        .card-header h1 {
            font-size: 28px;

            color: #132238;

            margin-bottom: 9px;
        }


        .card-header p {
            font-size: 14px;

            color: #94a3b8;

            line-height: 1.5;
        }


        /* =====================================================
           ERROR MESSAGE
        ===================================================== */

        .error-box {
            background: #fff3f3;

            border: 1px solid #f5caca;

            color: #c24141;

            border-radius: 8px;

            padding: 11px 13px;

            font-size: 13px;

            margin-bottom: 20px;
        }


        .error-box ul {
            margin-left: 17px;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .form-group {
            margin-bottom: 20px;
        }


        .form-label {
            display: block;

            color: #334155;

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 8px;
        }


        .input-wrapper {
            position: relative;
        }


        .form-input {
            width: 100%;

            height: 48px;

            border: 1px solid #d8e3eb;

            border-radius: 8px;

            padding: 0 14px;

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

            font-size: 12px;

            margin-top: 6px;
        }


        /* =====================================================
           OPTIONS
        ===================================================== */

        .form-options {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-top: -3px;

            margin-bottom: 23px;
        }


        .remember {
            display: flex;

            align-items: center;

            gap: 7px;

            color: #64748b;

            font-size: 12px;

            cursor: pointer;
        }


        .remember input {
            accent-color: #1769aa;

            width: 14px;

            height: 14px;
        }


        .forgot {
            color: #1769aa;

            font-size: 12px;

            text-decoration: none;

            font-weight: 600;
        }


        .forgot:hover {
            color: #12598f;

            text-decoration: underline;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .login-button {
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


        .login-button:hover {
            background: #12598f;

            transform: translateY(-1px);
        }


        .login-button:active {
            transform: translateY(0);
        }


        /* =====================================================
           DIVIDER
        ===================================================== */

        .divider {
            display: flex;

            align-items: center;

            gap: 12px;

            margin: 25px 0;
        }


        .divider-line {
            flex: 1;

            height: 1px;

            background: #e8eef3;
        }


        .divider span {
            color: #a0acb8;

            font-size: 11px;
        }


        /* =====================================================
           REGISTER LINK
        ===================================================== */

        .register-text {
            text-align: center;

            color: #64748b;

            font-size: 13px;
        }


        .register-text a {
            color: #1769aa;

            font-weight: 700;

            text-decoration: none;
        }


        .register-text a:hover {
            text-decoration: underline;
        }


        /* =====================================================
           SECURITY NOTE
        ===================================================== */

        .security-note {
            display: flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            margin-top: 22px;

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
                    35px 18px;
            }


            .login-card {
                padding:
                    32px 24px 28px;
            }


            .card-header h1 {
                font-size: 25px;
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
            style="text-decoration: none;"
        >

            <div class="logo-icon"></div>

            ClinicCare

        </a>


        <a
            href="{{ route('register') }}"
            class="header-link"
        >
            Don't have an account?
            <span>Register</span>
        </a>

    </header>


    <!-- Main -->

    <main>


        <div class="login-card">


            <!-- Card Header -->

            <div class="card-header">

                <div class="card-icon"></div>

                <h1>
                    Welcome Back
                </h1>

                <p>
                    Sign in to access your clinic management system.
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


            <!-- Login Form -->

            <form
                method="POST"
                action="{{ route('login') }}"
            >

                @csrf


                <!-- Email -->

                <div class="form-group">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Email Address
                    </label>


                    <div class="input-wrapper">

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input @error('email') is-invalid @enderror"
                            placeholder="Enter your email"
                            required
                            autofocus
                            autocomplete="email"
                        >

                    </div>


                    @error('email')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- Password -->

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
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >


                    @error('password')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- Options -->

                <div class="form-options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        Remember me

                    </label>


                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="forgot"
                        >
                            Forgot password?
                        </a>

                    @endif

                </div>


                <!-- Submit -->

                <button
                    type="submit"
                    class="login-button"
                >
                    Sign In
                </button>


            </form>


            <!-- Divider -->

            <div class="divider">

                <div class="divider-line"></div>

                <span>OR</span>

                <div class="divider-line"></div>

            </div>


            <!-- Register -->

            <div class="register-text">

                Don't have an account?

                <a href="{{ route('register') }}">
                    Create an account
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


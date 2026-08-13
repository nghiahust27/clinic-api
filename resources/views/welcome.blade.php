
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>TomaClinic- Clinic Management System</title>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        /* ====================================================
           BODY
        ===================================================== */
        body {
            font-family:
                Arial,
                Helvetica,
                sans-serif;
            min-height: 100vh;
            color: #172033;
            background: #f6fbff;
            overflow-x: hidden;
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
            z-index: 20;
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
           NAVIGATION
        ===================================================== */
        nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        nav a {
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .nav-login {
            color: #1769aa;
            padding: 11px 24px;
            border: 1px solid #b9d5eb;
            border-radius: 8px;
        }

        .nav-login:hover {
            background: #f0f7fd;
        }

        .nav-signup {
            color: white;
            background: #1769aa;
            padding: 12px 25px;
            border-radius: 8px;
            box-shadow:
                0 5px 12px rgba(23, 105, 170, 0.18);
        }


        .nav-signup:hover {

            background: #12598f;

            transform: translateY(-1px);
        }


        /* =====================================================
           HERO
        ===================================================== */
        .hero {
            min-height:
                calc(100vh - 78px);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding:
                65px 40px 80px;
        }

        /* =====================================================
           BACKGROUND DECORATION
        ===================================================== */

        .background-circle {
            position: absolute;
            border-radius: 50%;

            z-index: 0;
            pointer-events: none;
        }

        .circle-one {

            width: 480px;
            height: 480px;

            background: #e8f5ff;

            top: -190px;

            right: -100px;
        }


        .circle-two {

            width: 340px;
            height: 340px;

            background: #edf9f7;

            bottom: -160px;

            left: -120px;
        }


        .circle-three {

            width: 125px;
            height: 125px;

            border:
                24px solid #e1f0fa;

            background: transparent;

            top: 160px;

            left: 8%;
        }


        .circle-four {

            width: 18px;
            height: 18px;

            background: #b8dfed;

            top: 250px;

            right: 13%;
        }


        /* =====================================================
           HERO CONTENT
        ===================================================== */

        .hero-content {

            width: 1150px;

            max-width: 100%;

            display: grid;

            grid-template-columns:
                1fr 1fr;

            align-items: center;

            gap: 65px;

            position: relative;

            z-index: 5;
        }


        /* =====================================================
           HERO LEFT
        ===================================================== */

        .hero-left {

            text-align: left;
        }


        /* =====================================================
           BADGE
        ===================================================== */

        .badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            background: #e7f4ff;

            color: #1769aa;

            padding: 8px 14px;

            border-radius: 30px;

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 22px;
        }


        .badge-dot {

            width: 8px;
            height: 8px;

            background: #2a9d8f;

            border-radius: 50%;
        }


        /* =====================================================
           HERO TITLE
        ===================================================== */

        h1 {

            font-size: 57px;

            line-height: 1.1;

            color: #132238;

            margin-bottom: 22px;

            letter-spacing: -1.8px;
        }


        h1 span {

            color: #1769aa;
        }


        /* =====================================================
           SUBTITLE
        ===================================================== */

        .subtitle {

            font-size: 18px;

            line-height: 1.7;

            color: #64748b;

            max-width: 530px;

            margin-bottom: 32px;
        }


        /* =====================================================
           BUTTONS
        ===================================================== */

        .actions {

            display: flex;

            gap: 13px;

            width: 400px;

            max-width: 100%;
        }


        .btn {

            height: 52px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            text-decoration: none;

            font-size: 15px;

            font-weight: 700;

            transition: 0.2s ease;
        }


        .btn-primary {

            flex: 1;

            background: #1769aa;

            color: white;

            box-shadow:
                0 7px 18px rgba(23, 105, 170, 0.20);
        }


        .btn-primary:hover {

            background: #12598f;

            transform: translateY(-1px);
        }


        .btn-secondary {

            flex: 1;

            color: #1769aa;

            background: white;

            border: 1px solid #b9d5eb;
        }


        .btn-secondary:hover {

            background: #f2f8fc;

            transform: translateY(-1px);
        }


        /* =====================================================
           HERO RIGHT
        ===================================================== */

        .hero-right {

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            min-height: 430px;
        }


        /* =====================================================
           MEDICAL ILLUSTRATION
        ===================================================== */

        .medical-illustration {

            width: 440px;

            height: 410px;

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;
        }


        /* =====================================================
           ILLUSTRATION BACKGROUND
        ===================================================== */

        .medical-circle {

            position: absolute;

            border-radius: 50%;
        }


        .circle-a {

            width: 330px;

            height: 330px;

            background: #e9f5fc;

            top: 35px;

            left: 55px;
        }


        .circle-b {

            width: 250px;

            height: 250px;

            border: 1px solid #cce5f4;

            background: transparent;

            top: 75px;

            left: 95px;
        }


        /* =====================================================
           MAIN MEDICAL CROSS
        ===================================================== */

        .medical-symbol {

            width: 125px;

            height: 125px;

            background: #1769aa;

            border-radius: 35px;

            position: relative;

            z-index: 2;

            box-shadow:
                0 20px 35px
                rgba(23, 105, 170, 0.25);
        }


        .cross-horizontal {

            width: 62px;

            height: 18px;

            background: white;

            border-radius: 7px;

            position: absolute;

            top: 53px;

            left: 31px;
        }


        .cross-vertical {

            width: 18px;

            height: 62px;

            background: white;

            border-radius: 7px;

            position: absolute;

            top: 31px;

            left: 53px;
        }


        /* =====================================================
           HEARTBEAT CARD
        ===================================================== */

        .heartbeat-card {

            width: 185px;

            height: 95px;

            position: absolute;

            top: 25px;

            right: -5px;

            background: white;

            border-radius: 14px;

            border: 1px solid #e2edf4;

            box-shadow:
                0 15px 35px
                rgba(30, 70, 100, 0.12);

            padding: 18px;

            z-index: 3;
        }


        .heartbeat-line {

            height: 30px;

            display: flex;

            align-items: center;

            gap: 4px;

            margin-bottom: 8px;
        }


        .heartbeat-line span {

            display: block;

            width: 5px;

            background: #2a9d8f;

            border-radius: 5px;
        }


        .heartbeat-line span:nth-child(1) {

            height: 9px;
        }


        .heartbeat-line span:nth-child(2) {

            height: 17px;
        }


        .heartbeat-line span:nth-child(3) {

            height: 27px;
        }


        .heartbeat-line span:nth-child(4) {

            height: 13px;
        }


        .heartbeat-line span:nth-child(5) {

            height: 20px;
        }


        .heartbeat-text {

            color: #64748b;

            font-size: 11px;

            font-weight: 700;
        }


        /* =====================================================
           DOCTOR CARD
        ===================================================== */

        .doctor-card {

            width: 170px;

            height: 80px;

            position: absolute;

            left: -5px;

            bottom: 70px;

            background: white;

            border-radius: 14px;

            border: 1px solid #e2edf4;

            box-shadow:
                0 15px 35px
                rgba(30, 70, 100, 0.12);

            display: flex;

            align-items: center;

            padding: 15px;

            gap: 12px;

            z-index: 3;
        }


        .doctor-icon {

            width: 42px;

            height: 42px;

            background: #e5f4f1;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #16877f;

            font-size: 22px;

            font-weight: bold;
        }


        .doctor-lines {

            flex: 1;
        }


        .doctor-line {

            width: 75px;

            height: 8px;

            background: #a9bac7;

            border-radius: 10px;

            margin-bottom: 8px;
        }


        .doctor-line.small {

            width: 48px;

            height: 6px;

            background: #d2dde5;
        }


        /* =====================================================
           CALENDAR CARD
        ===================================================== */

        .calendar-card {

            width: 100px;

            height: 105px;

            position: absolute;

            right: 5px;

            bottom: 45px;

            background: white;

            border-radius: 14px;

            border: 1px solid #e2edf4;

            box-shadow:
                0 15px 35px
                rgba(30, 70, 100, 0.12);

            overflow: hidden;

            z-index: 3;
        }


        .calendar-top {

            height: 27px;

            background: #e7f3fb;
        }


        .calendar-grid {

            padding: 14px;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 7px;
        }


        .calendar-grid span {

            width: 9px;

            height: 9px;

            border-radius: 3px;

            background: #c7d8e4;
        }


        .calendar-grid span:nth-child(2),
        .calendar-grid span:nth-child(5) {

            background: #5ca8d3;
        }


        /* =====================================================
           MEDICAL LABEL
        ===================================================== */

        .medical-label {

            position: absolute;

            bottom: -10px;

            left: 115px;

            background: white;

            border-radius: 13px;

            padding: 12px 17px;

            display: flex;

            align-items: center;

            gap: 10px;

            border: 1px solid #e2edf4;

            box-shadow:
                0 12px 30px
                rgba(30, 70, 100, 0.12);

            z-index: 4;
        }


        .label-icon {

            width: 31px;

            height: 31px;

            background: #e4f5f1;

            color: #16877f;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 14px;

            font-weight: bold;
        }


        .medical-label strong {

            display: block;

            color: #243b53;

            font-size: 11px;

            margin-bottom: 3px;
        }


        .medical-label small {

            color: #94a3b8;

            font-size: 9px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        footer {

            position: absolute;

            bottom: 20px;

            left: 0;

            right: 0;

            text-align: center;

            color: #94a3b8;

            font-size: 12px;

            z-index: 5;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1000px) {

            header {

                padding: 0 30px;
            }


            .hero-content {

                grid-template-columns: 1fr;

                gap: 40px;

                text-align: center;
            }


            .hero-left {

                text-align: center;
            }


            .subtitle {

                margin-left: auto;

                margin-right: auto;
            }


            .actions {

                margin-left: auto;

                margin-right: auto;
            }


            .hero-right {

                min-height: 390px;
            }
        }


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

            .nav-login {

                padding: 9px 14px;
            }


            .nav-signup {

                padding: 10px 15px;
            }


            h1 {

                font-size: 40px;

                letter-spacing: -1px;
            }


            .subtitle {

                font-size: 16px;
            }


            .actions {

                width: 100%;
            }


            .hero {

                padding:
                    45px 20px 70px;
            }


            .hero-right {

                transform: scale(0.75);

                margin-top: -30px;

                margin-bottom: -40px;
            }


            footer {

                position: relative;

                bottom: auto;

                margin-top: 35px;
            }
        }

    </style>

</head>


<body>


    <!-- =====================================================
         HEADER
    ===================================================== -->

    <header>

        <div class="logo">

            <div class="logo-icon"></div>

            TomaClinic

        </div>


        <nav>

            <a
                href="{{ route('login') }}"
                class="nav-login"
            >
                Log In
            </a>


        </nav>

    </header>


    <!-- =====================================================
         HERO
    ===================================================== -->

    <main class="hero">


        <!-- Background -->

        <div class="background-circle circle-one"></div>

        <div class="background-circle circle-two"></div>

        <div class="background-circle circle-three"></div>

        <div class="background-circle circle-four"></div>



        <div class="hero-content">


            <!-- =================================================
                 LEFT CONTENT
            ================================================= -->

            <section class="hero-left">


                <div class="badge">

                    <span class="badge-dot"></span>

                    Modern Clinic Management

                </div>
                <h1>
                    Smarter Care.

                    <br>

                    <span>Better Management.</span>
                </h1>

                <p class="subtitle">
                   Your trusted healthcare partner, 
                   making quality care simple and accessible.
                </p>

                <div class="actions">

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-secondary"
                    >
                        Log In
                    </a>

                </div>
            </section>

            <!-- =================================================
                 RIGHT MEDICAL ILLUSTRATION
            ================================================= -->

            <section class="hero-right">


                <div class="medical-illustration">

                    <!-- Decorative circles -->

                    <div class="medical-circle circle-a"></div>

                    <div class="medical-circle circle-b"></div>


                    <!-- Main medical symbol -->

                    <div class="medical-symbol">

                        <div class="cross-horizontal"></div>

                        <div class="cross-vertical"></div>

                    </div>



                    <!-- Heartbeat -->

                    <div class="heartbeat-card">

                        <div class="heartbeat-line">

                            <span></span>

                            <span></span>

                            <span></span>

                            <span></span>

                            <span></span>

                        </div>


                        <div class="heartbeat-text">

                            Patient Care

                        </div>

                    </div>



                    <!-- Doctor -->

                    <div class="doctor-card">

                        <div class="doctor-icon">

                            +

                        </div>


                        <div class="doctor-lines">

                            <div class="doctor-line"></div>

                            <div class="doctor-line small"></div>

                        </div>

                    </div>



                    <!-- Calendar -->

                    <div class="calendar-card">

                        <div class="calendar-top"></div>


                        <div class="calendar-grid">

                            <span></span>

                            <span></span>

                            <span></span>

                            <span></span>

                            <span></span>

                            <span></span>

                        </div>

                    </div>



                    <!-- Label -->

                    <div class="medical-label">

                        <div class="label-icon">

                            ✓

                        </div>


                        <div>

                            <strong>
                                Better Care
                            </strong>

                            <small>
                                One platform
                            </small>

                        </div>

                    </div>


                </div>

            </section>


        </div>


        <!-- =================================================
             FOOTER
        ================================================= -->

        <footer>

            © {{ date('Y') }} ClinicCare ·
            Secure Clinic Management System

        </footer>


    </main>


</body>

</html>

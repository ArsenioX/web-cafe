<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #8B6F47;
            --secondary-color: #D4A574;
            --dark-color: #2C2416;
            --light-bg: #f8f7f5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            padding-top: 70px;
            background-color: var(--light-bg);
            font-family: 'Nunito', sans-serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--dark-color) 0%, #3d3228 100%) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-bottom: 3px solid var(--secondary-color);
        }

        .navbar .nav-link,
        .navbar .navbar-brand,
        .navbar .dropdown-toggle {
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.4rem;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        .navbar-brand::before {
            content: '☕ ';
        }

        .navbar .dropdown-toggle::after {
            display: none;
        }

        /* Navbar Toggler Custom */
        .navbar-toggler-icon-custom {
            cursor: pointer;
            width: 25px;
            height: 20px;
            display: inline-block;
            position: relative;
        }

        .navbar-toggler-icon-custom span {
            background: white;
            position: absolute;
            height: 3px;
            width: 100%;
            left: 0;
            transition: 0.3s ease;
            border-radius: 2px;
        }

        .navbar-toggler-icon-custom span:nth-child(1) {
            top: 0;
        }

        .navbar-toggler-icon-custom span:nth-child(2) {
            top: 8px;
        }

        .navbar-toggler-icon-custom span:nth-child(3) {
            top: 16px;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            animation: slideIn 0.2s ease;
        }

        .dropdown-item {
            color: var(--dark-color);
            transition: all 0.3s ease;
            padding: 12px 20px;
            border-radius: 6px;
            margin: 4px 8px;
        }

        .dropdown-item:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Main Container */
        main.container {
            background: white;
            border-radius: 12px;
            padding: 30px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            min-height: calc(100vh - 150px);
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding-top: 60px;
            }

            main.container {
                padding: 20px !important;
                margin-top: 10px;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="container-fluid d-flex justify-content-between align-items-center px-4">
                <a class="navbar-brand fw-bold" href="{{ url('/admin/dashboard') }}">
                    {{ Auth::user()->name }}
                </a>

                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-secondary d-none d-md-inline">Admin</span>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle navbar-toggler-icon-custom" href="#" id="dropdownMenuButton"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="{{ url('/admin/dashboard') }}">
                                    📊 Dashboard
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    🚪 Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>

        <main class="container py-4">
            @yield('content')
        </main>
    </div>

</body>

</html>
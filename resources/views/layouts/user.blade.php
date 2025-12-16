<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            padding-top: 70px;
        }

        .navbar {
            background: linear-gradient(135deg, #6b5745 0%, #a0917a 100%) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link,
        .navbar .navbar-brand,
        .navbar .dropdown-toggle {
            color: #faf9f7 !important;
            transition: color 0.3s ease;
        }

        .navbar .navbar-brand:hover,
        .navbar .nav-link:hover,
        .navbar .dropdown-toggle:hover {
            color: #3d3531 !important;
        }

        .navbar-toggler-icon-custom {
            cursor: pointer;
            width: 25px;
            height: 20px;
            display: inline-block;
            position: relative;
        }

        .navbar-toggler-icon-custom span {
            background: #faf9f7;
            position: absolute;
            height: 3px;
            width: 100%;
            left: 0;
            transition: 0.3s;
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

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            margin-top: 8px;
        }

        .dropdown-item {
            color: #3d3531;
            padding: 12px 20px;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f6f4;
            color: #6b5745;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top shadow-sm">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand fw-bold" href="{{ url('/user/dashboard') }}">
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown">
                    <a class="nav-link dropdown-toggle navbar-toggler-icon-custom" href="#" id="dropdownMenuButton"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        {{-- 1. Menu Kasir (Opsional, untuk balik ke home) --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                <i class="bi bi-shop me-2"></i> Menu Kasir
                            </a>
                        </li>
                    
                        {{-- 2. Menu Riwayat Pesanan (YANG BARU DITAMBAHKAN) --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('user.history') }}">
                                <i class="bi bi-clock-history me-2"></i> Riwayat Pesanan
                            </a>
                        </li>
                    
                        {{-- Garis Pemisah --}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    
                        {{-- 3. Menu Logout --}}
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
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
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #6b5745;
            --secondary-color: #a0917a;
            --dark-color: #3d3531;
            --light-bg: #faf9f7;
            --accent: #7a6f68;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Nunito', sans-serif;
        }

        /* Navbar */
        .navbar {
            background: #3d3531 !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid #e0dcd8;
            padding: 0.6rem 0;
        }

        .navbar-brand {
            font-size: 1.2rem;
            font-weight: 700;
            color: #c9b5a5 !important;
            letter-spacing: 0.3px;
        }

        .navbar-brand::before {
            content: '🏪 ';
            margin-right: 6px;
        }

        .navbar-light .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.75) !important;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.4rem 0.8rem !important;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #c9b5a5 !important;
        }

        .navbar-light .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 1px;
            background: #c9b5a5;
            transition: width 0.3s ease;
        }

        .navbar-light .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        /* Dropdown */
        .dropdown-menu {
            border: 1px solid #e0dcd8;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            animation: slideDown 0.2s ease;
            background: white;
        }

        .dropdown-item {
            color: #5a5551;
            transition: all 0.3s ease;
            padding: 12px 20px;
            border-radius: 6px;
            margin: 2px 4px;
        }

        .dropdown-item:hover {
            background-color: #f5f2f0;
            color: #3d3531;
            transform: none;
        }

        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: 2px solid #c9b5a5;
            outline-offset: 2px;
        }

        /* Main Content */
        main {
            padding: 40px 20px !important;
            min-height: calc(100vh - 100px);
        }

        main>.container {
            background: white;
            border-radius: 12px;
            padding: 30px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #f0ede9;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.1rem;
            }

            .navbar-light .navbar-nav .nav-link {
                font-size: 0.9rem;
                padding: 0.3rem 0.6rem !important;
            }

            main {
                padding: 20px 10px !important;
            }

            main>.container {
                padding: 20px !important;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
@extends('layouts.app')

@section('content')
    <style>
        :root {
            --primary-color: #6b5745;
            --secondary-color: #a0917a;
            --dark-color: #3d3531;
            --light-bg: #faf9f7;
        }

        .login-container {
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            border: 1px solid #e0dcd8;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            background: white;
            overflow: hidden;
        }

        .login-card-header {
            background: white;
            border-bottom: 2px solid #e0dcd8;
            text-align: center;
            padding: 20px !important;
        }

        .login-card-header h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            color: #6b5745;
            letter-spacing: 0px;
        }

        .login-card-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #5a5551;
            font-size: 0.95rem;
        }

        .form-control {
            border: 1px solid #d8d4cf;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-control:focus {
            border-color: #a0917a;
            background: white;
            box-shadow: 0 0 0 3px rgba(160, 145, 122, 0.08);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            background: #fff8f9;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
        }

        .invalid-feedback {
            display: block;
            margin-top: 8px;
            color: #dc3545;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 12px;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 1px solid #d8d4cf;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            accent-color: #6b5745;
        }

        .form-check-input:hover {
            border-color: #a0917a;
        }

        .form-check-label {
            cursor: pointer;
            color: #5a5551;
            font-size: 0.95rem;
            margin: 0;
            user-select: none;
        }

        .form-actions {
            margin-top: 32px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-login {
            background: #6b5745;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(61, 53, 49, 0.12);
        }

        .btn-login:hover {
            background: #5a4d43;
            color: white;
            text-decoration: none;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-forgot {
            color: #6b5745;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-forgot:hover {
            color: #5a4d43;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-card-header {
                padding: 30px 20px;
            }

            .login-card-header h2 {
                font-size: 1.6rem;
            }

            .login-card-body {
                padding: 30px 20px;
            }

            .form-group {
                margin-bottom: 18px;
            }
        }
    </style>

    <div class="login-container">
        <div class="login-card">
            <div class="login-card-header">
                <h2>{{ __('Login') }}</h2>
            </div>

            <div class="login-card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="nama@email.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="••••••••">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-login">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn-forgot" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
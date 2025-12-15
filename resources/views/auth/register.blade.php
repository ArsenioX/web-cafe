@extends('layouts.app')

@section('content')
    <style>
        :root {
            --primary-color: #6b5745;
            --secondary-color: #a0917a;
            --dark-color: #3d3531;
            --light-bg: #faf9f7;
        }

        .register-container {
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            width: 100%;
            max-width: 420px;
            border: 1px solid #e0dcd8;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            background: white;
            overflow: hidden;
        }

        .register-card-header {
            background: white;
            border-bottom: 2px solid #e0dcd8;
            text-align: center;
            padding: 20px !important;
        }

        .register-card-header h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            color: #6b5745;
            letter-spacing: 0px;
        }

        .register-card-body {
            padding: 32px;
        }

        .form-group {
            margin-bottom: 20px;
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
            width: 100%;
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
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }

        .invalid-feedback {
            display: block;
            margin-top: 8px;
            color: #dc3545;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .form-actions {
            margin-top: 28px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-register {
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

        .btn-register:hover {
            background: #5a4d43;
            color: white;
            text-decoration: none;
        }

        .register-footer {
            margin-top: 20px;
            text-align: center;
            color: #5a5551;
            font-size: 0.95rem;
        }

        .register-footer a {
            color: #6b5745;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .register-footer a:hover {
            color: #5a4d43;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .register-card-header {
                padding: 20px !important;
            }

            .register-card-header h2 {
                font-size: 1.2rem;
            }

            .register-card-body {
                padding: 30px 20px;
            }

            .form-group {
                margin-bottom: 18px;
            }
        }
    </style>

    <div class="register-container">
        <div class="register-card">
            <div class="register-card-header">
                <h2>{{ __('Register') }}</h2>
            </div>

            <div class="register-card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Nama lengkap Anda">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
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
                            name="password" required autocomplete="new-password" placeholder="••••••••">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="••••••••">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-register">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

                <div class="register-footer">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
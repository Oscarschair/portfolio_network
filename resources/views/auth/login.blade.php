@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}?v={{ time() }}" rel="stylesheet">

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-card-header">
            <h1 class="auth-card-title">{{ __('auth.Login') }}</h1>
            <p class="auth-card-subtitle">Portfolio Network へようこそ</p>
        </div>

        <!-- Google Social Login -->
        <a href="/login/google" class="btn-google" role="button">
            <img src="{{ asset('img/google_logo.png') }}" width="20" height="20" alt="Google"/>
            <span>Google でログイン</span>
        </a>

        <div class="auth-divider">
            <span>またはメールアドレスでログイン</span>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="auth-form-group">
                <label for="email" class="auth-label">{{ __('auth.email') }}</label>
                <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">

                @error('email')
                    <span class="auth-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="auth-form-group">
                <label for="password" class="auth-label">{{ __('auth.password') }}</label>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">

                @error('password')
                    <span class="auth-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Remember & Forgot Password -->
            <div class="auth-options">
                <label class="auth-checkbox-label" for="remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>{{ __('auth.remember Me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: var(--color-primary); font-size: 13px; font-weight: 500;">
                        {{ __('auth.Forgot Your Password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-auth-submit">
                {{ __('auth.Login') }}
            </button>

            <!-- Bottom Register Link -->
            <div class="auth-footer-links">
                <span>アカウントをお持ちでないですか？</span>
                <a href="{{ route('register') }}">{{ __('auth.register') }}（無料）</a>
            </div>
        </form>
    </div>
</div>
@endsection

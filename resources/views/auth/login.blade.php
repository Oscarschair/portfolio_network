@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}?v={{ time() }}" rel="stylesheet">

@php
    $lastLoginMethod = request()->cookie('last_login_method');
@endphp

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-card-header">
            <h1 class="auth-card-title">{{ __('auth.Login') }}</h1>
            <p class="auth-card-subtitle">Portfolio Network へようこそ</p>
        </div>

        <!-- Google Social Login Container -->
        <div class="login-method-group" id="google-login-group">
            <div class="last-used-badge-wrapper {{ $lastLoginMethod === 'google' ? 'is-visible' : '' }}" id="badge-google">
                <span class="last-used-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    前回使用したログイン方法
                </span>
            </div>
            
            <a href="/login/google" class="btn-google {{ $lastLoginMethod === 'google' ? 'is-last-used' : '' }}" id="btn-google-login" role="button" onclick="localStorage.setItem('last_login_method', 'google');">
                <img src="{{ asset('img/google_logo.png') }}" width="20" height="20" alt="Google"/>
                <span>Google でログイン</span>
            </a>
        </div>

        <div class="auth-divider">
            <span>またはメールアドレスでログイン</span>
        </div>

        <!-- Email Password Login Form -->
        <form method="POST" action="{{ route('login') }}" id="email-login-form" onsubmit="localStorage.setItem('last_login_method', 'email');">
            @csrf

            <!-- Email Last Used Badge (if applicable) -->
            <div class="last-used-badge-wrapper {{ $lastLoginMethod === 'email' ? 'is-visible' : '' }}" id="badge-email" style="margin-bottom: 8px;">
                <span class="last-used-pill email-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    前回使用したログイン方法
                </span>
            </div>

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
            <button type="submit" class="btn-auth-submit {{ $lastLoginMethod === 'email' ? 'is-last-used' : '' }}">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check localStorage as well for instant client-side update
    var storedMethod = localStorage.getItem('last_login_method');
    if (storedMethod === 'google') {
        var badgeG = document.getElementById('badge-google');
        var btnG = document.getElementById('btn-google-login');
        if (badgeG) badgeG.classList.add('is-visible');
        if (btnG) btnG.classList.add('is-last-used');
        
        var badgeE = document.getElementById('badge-email');
        if (badgeE) badgeE.classList.remove('is-visible');
    } else if (storedMethod === 'email') {
        var badgeE = document.getElementById('badge-email');
        if (badgeE) badgeE.classList.add('is-visible');
        
        var badgeG = document.getElementById('badge-google');
        var btnG = document.getElementById('btn-google-login');
        if (badgeG) badgeG.classList.remove('is-visible');
        if (btnG) btnG.classList.remove('is-last-used');
    }
});
</script>
@endsection

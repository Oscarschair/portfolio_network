@extends('layouts.app')

@section('content')
<link href="{{ asset('css/register.css') }}?v={{ time() }}" rel="stylesheet">

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-card-header">
            <h1 class="auth-card-title">{{ __('auth.register') }}</h1>
            <p class="auth-card-subtitle">才能を発信し、新しいチャンスと繋がろう</p>
        </div>

        <!-- Google Social Signup -->
        <a href="/login/google" class="btn-google" role="button">
            <img src="{{ asset('img/google_logo.png') }}" width="20" height="20" alt="Google"/>
            <span>Google で登録</span>
        </a>

        <div class="auth-divider">
            <span>またはメールアドレスで登録</span>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Email Field -->
            <div class="auth-form-group">
                <label for="email" class="auth-label">{{ __('auth.email') }}</label>
                <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">

                @error('email')
                    <span class="auth-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="auth-form-group">
                <label for="password" class="auth-label">{{ __('auth.password') }}</label>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="8文字以上の半角英数字">

                @error('password')
                    <span class="auth-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password Confirmation Field -->
            <div class="auth-form-group">
                <label for="password-confirm" class="auth-label">{{ __('auth.Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="auth-input" name="password_confirmation" required autocomplete="new-password" placeholder="もう一度パスワードを入力">
            </div>

            <!-- Terms & Privacy Policy Checkbox -->
            <div class="auth-terms">
                <label class="auth-terms-label" for="terms">
                    <input type="checkbox" name="terms" id="terms" required>
                    <span>
                        <a href="{{ route('terms') }}" target="_blank">利用規約</a> および <a href="{{ route('privacypolicy') }}" target="_blank">プライバシーポリシー</a> に同意の上、登録します。
                    </span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-auth-submit">
                {{ __('auth.register') }}（無料）
            </button>

            <!-- Bottom Login Link -->
            <div class="auth-footer-links">
                <span>既にアカウントをお持ちですか？</span>
                <a href="{{ route('login') }}">{{ __('auth.Login') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<link href="{{ asset('css/login.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="OSCSS-content-box-inner">
            <div class="card" style="margin-top:20px;">
                <div class="card-header">{{ __('auth.Login') }}</div>
                <div class="card-body">
                    <div class="form-group row mt-2">
                        <div class="OSCSS-socialLoginList">
                            <a href="/login/facebook" class="btn btn-forSocial" role="button">
                                <img src="img/facebook_logo.png" width="20" height="20"/><span style="margin-left:20px;">Facebookでログイン</span>
                            </a>
                            <a href="/login/google" class="btn btn-forSocial" role="button">
                                <img src="img/google_logo.png" width="20" height="20"/><span style="margin-left:20px;">Googleでログイン</span>
                            </a>
                        </div>
                    </div>
                    <div class="OSCSS-login-line"><span>または</span></div>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.Login') }}
                                </button>
                                <br>
                                <a class="btn btn-link form-sublinks" href="{{ route('register') }}">
                                    {{ __('auth.Already have an account?') }}
                                </a>
                                <br>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link form-sublinks" href="{{ route('password.request') }}">
                                        {{ __('auth.Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<link href="{{ asset('css/register.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
<script src="{{ asset('js/register.js') }}" defer></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="OSCSS-content-box-inner">
            <div class="card" style="margin-top:20px;">
                <div class="card-header">{{ __('auth.register') }}</div>
                <div class="card-body">
                    <div class="form-group row mt-2">
                        <div class="OSCSS-socialLoginList">
                            <a href="/login/google" class="btn btn-forGoogle" role="button">
                                <img src="img/google_logo.png" width="20" height="20"/><span style="margin-left:20px;">Googleで登録</span>
                            </a>
                        </div>
                    </div>
                    <div class="OSCSS-register-line"><span>または</span></div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('auth.Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                        <label class="form-check-label" for="terms">
                          <a href="{{route('terms')}}">利用規約</a>および<a href="{{route('privacypolicy')}}">プライバシーポリシー</a>の内容に同意し、登録します。
                        </label>
                        <div class="form-group row mb-0" style="margin-top: 10px;">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top:20px;">
                <div class="card-header">{{ __('auth.Revoke Request') }}</div>
                <div class="card-body">
                    {{ __('auth.Revoked.') }}<br>
                    <a class="btn btn-link p-0 align-baseline" style="width: 100%" href="{{route('welcome')}}">{{ __('auth.Back to homepage')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

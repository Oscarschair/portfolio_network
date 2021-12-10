@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top:20px;">
                <div class="card-header">{{ __('auth.Revoke Request') }}</div>

                <div class="card-body">
                    {{ __('auth.After revoke, registered information and protfolio data will no longer able to be recovered.') }}<br>
                    {{ __('auth.Do you confirm to revoke?') }}<br><br>
                    <form class="d-inline" method="POST" action="{{ route('revoke_consent') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.I understood and revoke anyway.') }}</button>
                    </form>
                    <a class="btn btn-link p-0 align-baseline" style="margin-left: 50px;" href="{{route('myprofile')}}">{{ __('auth.No, please cancel my request.')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

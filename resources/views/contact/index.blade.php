@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/contact.css') }}" rel="stylesheet">
<script src="{{ asset('js/contact.js') }}" defer></script>
<div class="container">
<div class="justify-content-center">
  <div class="OSCSS-content-box">
    <div class="OSCSS-content-box-inner">
      <h2 class="animate-box-up">お問い合わせ</h2>
      <hr>
      <div id="OSCSS-content-contact">
        <form action="{{route('contact.send')}}" id="contact" method="post" enctype="multipart/form-data">
          @csrf
	        <div class="form-group">
                    <label for="formInputName">{{ __('auth.name') }}</label>
                    <input type="text" class="form-control" id="formInputName" name="name" value="@auth{{$user->name}}@endauth">
 
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
 
                <div class="form-group">
                    <label for="formInputEmail">{{ __('auth.email') }}</label>
                    <input type="text" class="form-control" id="formInputEmail" name="email" value="@auth{{$user->email}}@endauth">
 
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
 
                <div class="form-group">
                    <label for="formInputEmail">{{ __('auth.message') }}</label>
                    <textarea class="form-control" id="formInputMessage" name="message" value="" placeholder="お問合せ・ご意見・ご要望はこちらから承ります。">{{ old('message') }}</textarea>
 
                    @if ($errors->has('message'))
                        <span class="help-block">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>
 
                <button type="submit" class="btn btn-primary">{{ __('auth.Submit') }}</button>
        </form>
      </div>
    </div>  
  </div>
</div>
</div>
@endsection

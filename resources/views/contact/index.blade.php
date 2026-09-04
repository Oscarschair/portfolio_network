@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/contact.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('js/contact.js') }}?v={{ time() }}" defer></script>

<div class="container">
  <div class="justify-content-center">
    <div class="contact-card animate-box-up">
      <div class="contact-header">
        <h1 class="contact-title">お問い合わせ</h1>
        <p class="contact-subtitle">ご意見・ご要望・不具合のご報告など、お気軽にお問い合わせください。</p>
      </div>

      <form action="{{route('contact.send')}}" id="contact" method="post" enctype="multipart/form-data" class="contact-form">
        @csrf
        
        <div class="form-group">
          <label for="formInputName">{{ __('auth.name') }}</label>
          <input type="text" class="form-control" id="formInputName" name="name" value="@auth{{$user->name}}@endauth" required placeholder="お名前を入力">
          @if ($errors->has('name'))
            <span class="help-block" style="color: #f87171; font-size: 0.85rem; margin-top: 4px; display: block;">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group">
          <label for="formInputEmail">{{ __('auth.email') }}</label>
          <input type="email" class="form-control" id="formInputEmail" name="email" value="@auth{{$user->email}}@endauth" required placeholder="example@domain.com">
          @if ($errors->has('email'))
            <span class="help-block" style="color: #f87171; font-size: 0.85rem; margin-top: 4px; display: block;">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group">
          <label for="formInputMessage">{{ __('auth.message') }}</label>
          <textarea class="form-control" id="formInputMessage" name="message" required placeholder="お問い合わせ内容をご入力ください。">{{ old('message') }}</textarea>
          @if ($errors->has('message'))
            <span class="help-block" style="color: #f87171; font-size: 0.85rem; margin-top: 4px; display: block;">
              <strong>{{ $errors->first('message') }}</strong>
            </span>
          @endif
        </div>

        <div class="submit-btn-block">
          <button type="submit" class="btn btn-primary">{{ __('auth.Submit') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

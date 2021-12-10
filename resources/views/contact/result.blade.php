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
      <h3>ありがとうございます。</h3>
      <p>お問い合わせ内容が送信されました。</p>
    </div>  
  </div>
</div>
</div>
@endsection

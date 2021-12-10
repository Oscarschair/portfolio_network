@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/terms.css') }}" rel="stylesheet">
<div class="container">
<div class="justify-content-center">
  <div class="OSCSS-content-box">
    <div class="OSCSS-content-box-inner">
      <h2 class="animate-box-up">運営について</h2>
      <hr>
      <h3>サービス名</h3>
      <p>Portifolio Network（ピーネット）</p>
      <h3>運営事務局</h3>
      <p>OSCARCHAIR.JP</p>
      <h3>お問い合わせ</h3>
      <p>ページ下部のお問い合わせフォームよりご連絡ください。</p>
    </div>  
  </div>
</div>
</div>
@endsection

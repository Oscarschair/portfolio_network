@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/company.css') }}?v={{ time() }}" rel="stylesheet">
<div class="container">
<div class="justify-content-center">
  <div class="doc-card animate-box-up">
    <div class="doc-content">
      <h1 class="doc-title">運営について</h1>
      
      <table class="company-table">
        <tr>
          <th>サービス名</th>
          <td>Portfolio Network（ポートフォリオ ネットワーク）</td>
        </tr>
        <tr>
          <th>運営組織</th>
          <td>OSCARCHAIR.JP 運営事務局</td>
        </tr>
        <tr>
          <th>URL</th>
          <td><a href="https://oscarchair.jp" target="_blank" rel="noopener noreferrer" style="color: var(--primary, #6366f1);">https://oscarchair.jp</a></td>
        </tr>
        <tr>
          <th>事業内容</th>
          <td>クリエイター向けポートフォリオ共有・検索プラットフォームの開発・運営</td>
        </tr>
        <tr>
          <th>お問い合わせ</th>
          <td><a href="{{ route('contact') }}" style="color: var(--primary, #6366f1); text-decoration: underline;">お問い合わせフォーム</a>よりご連絡ください。</td>
        </tr>
      </table>
    </div>  
  </div>
</div>
</div>
@endsection

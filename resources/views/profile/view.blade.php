@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/myprofile.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
<script src="{{ asset('js/filechecker.js') }}" defer></script>
<div class="container">
    <div class="justify-content-center">
      <h2>マイページ</h2>
      <div class="OSCSS-content-box">
        <div class="OSCSS-content-box-inner">
          <dl>
            <dt>
              <div class="OSCSS-profile-icon">
                @if ($user->icon_path == null)
                <img src="{{ asset('img/defaultProfileIcon.png') }}" width="150" height="150"/>
                @else
                <img src="{{ asset('userimages/'.$user->icon_path) }}" width="150" height="150"/>
                @endif
              </div>
            </dt>
          </dl>
	  <dl>
	    <dt>ユーザー名：</dt>
            <dd>{{$user->name}}</dd>
          </dl>
          <dl>
            <dt>自己紹介：</dt>
            <dd>{{$user->description}}</dd>
          </dl>
          <h2 class="OSCSS-subtitle">登録ポートフォリオ</h2>
	  <div class="OSCSS-profile-portfolio-list">
	    @foreach ($portfolios as $portfolio)
	    
	    @if ($portfolio->verified_at != null)
	    <div class="OSCSS-profile-portfolio-left">
	      <div class="OSCSS-profile-portfolio-pic">
	      <div class="OSCSS-profile-portfolio-pic-inner">
	        <a href="{{route('viewPortfolio', ['id' => $portfolio->id])}}">
                @if ($portfolio->icon_path == null)
                <img src="{{ asset('img/defaultPortfolioIcon.png') }}" width="300" height="200"/>
                @else
                <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" width="150" height="150"/>
                @endif
                </a>
              </div>
              </div>
	    </div>
	    <div class="OSCSS-profile-portfolio-right">
	      <table class="OSCSS-portfolio-table">
	        <tr><td>タイトル</td><td>{{$portfolio->title}}</td></tr>
	        <tr><td>詳細内容</td><td class="OSCSS-profile-portfolio-desc">{{$portfolio->description}}</td></tr>
	        <tr><td>タイプ</td><td>{{$portfolioTypes[$portfolio->type]}}</td></tr>
	      </table>
	    </div>
	    <hr>
	    @endif
	    @endforeach
          </div>
	</div>
      </div>
    </div>
</div>

	
@endsection

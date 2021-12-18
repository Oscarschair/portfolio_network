@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/portfolio.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
<!--script src="{{ asset('js/filechecker.js') }}" defer></script-->
@if($urlClicked)
<script>window.open('{{$urlClicked}}', '_blank')</script>
@endif
<div class="container">
    <div class="justify-content-center">
      @if ($portfolio->display_flag && $portfolio->verified_at)
      <h2 style="display: none;">ポートフォリオ</h2>
      <div class="OSCSS-content-box">
        <div class="OSCSS-content-box-inner">
          <div class="OSCSS-portfolio-header">
            <div class="OSCSS-portfolio-icon-area">
            <div class="OSCSS-portfolio-icon">
            <div class="OSCSS-portfolio-icon-inner">
              @if ($portfolio->icon_path == null)
              <img src="{{ asset('img/defaultPortfolioIcon.png') }}" width="150" height="150" alt="{{$portfolio->title}}"/>
              @else
              <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" width="150" height="150" alt="{{$portfolio->title}}"/>
              @endif
            </div>             
            </div>             
            </div>             
            <div class="OSCSS-portfolio-view">
              <span>{{$portfolio->view}}</span><br>
              <span>View</span>
            </div>
            <div class="OSCSS-portfolio-click">
              <span>{{$portfolio->click}}</span><br>
              <span>Click</span>
            </div>
          </div>
          <dl>
            <dt>所有者：</dt>
            <dd>
              <div class="OSCSS-portfolio-usericon">
                <a href="/profile/{{$user->id}}">
                @if ($user->icon_path == null)
                <img src="{{ asset('img/defaultProfileIcon.png') }}" width="150" height="150" alt="{{$user->name}}"/>
                @else
                <img src="{{ asset('userimages/'.$user->icon_path) }}" width="150" height="150" alt="{{$user->name}}"/>
                @endif
                </a>
              </div>
              <div class="OSCSS-portfolio-username">
                <span>{{$user->name}}</span>
              </div>
            </dd>
          </dl>
          
          <dl>
            <dt>URL：</dt>
            <dd style="display:block;">
            @auth
            <form action="{{ route('clickPortfolio', ['id' => $portfolio->id])}}" id="clickPortfolio" method="post" enctype="multipart/form-data">
                @csrf
                <div style="display:none;">
                  <input type="hidden" name="urlClicked" value="{{$portfolio->url}}">
                </div>
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{$portfolio->url}}</button>
            </form>
            @else
	        <a href="{{route('login')}}">ログイン</a>してURL確認できます。<br>アカウントお持ちでない場合、<a href="{{route('register')}}">登録</a>してください。
            @endauth
            </dd>
          </dl>
          <dl>
            <dt>タイトル：</dt>
            <dd>{{$portfolio->title}}</dd>
          </dl>
          <dl>
            <dt>詳細内容：</dt>
            <dd>{{$portfolio->description}}</dd>
          </dl>
          <dl>
            <dt>タイプ：</dt>
            <dd>{{$portfolioTypes[$portfolio->type]}}</dd>
          </dl>
	</div>
      </div>
      @else
      <div class="OSCSS-content-box">
        <div class="OSCSS-content-box-inner" style="text-align: center;">
          このポートフォリオは公開されておりません。
        </div>
      </div>
      @endif
    </div>
</div>

	
@endsection

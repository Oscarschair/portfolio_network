@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/portfolio.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
<!--script src="{{ asset('js/filechecker.js') }}" defer></script-->
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v12.0" nonce="CNjaHHdJ"></script>

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
        <div class="OSCSS-social-share">
          <div class="OSCSS-social-title">
            このポートフォリオを共有する
          </div>
          <div class="OSCSS-social-button">
            <div><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button " data-show-count="false" data-text="{{$portfolio->title}} | ポートフォリオネットワーク">Tweet</a></div>
            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェア</a></div>
          </div>
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

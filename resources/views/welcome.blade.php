@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
<script src="{{ asset('js/welcome.js') }}" defer></script>

<div class="justify-content-center">
  <section class="OSCSS-section-hero">
    <div class="OSCSS-section-hero-title">
      <span class="OSCSS-section-hero-caption animate-box-up">チャンスは準備された心に降り立つ</span><br>
      <span class="OSCSS-section-hero-label animate-box-up">ポートフォリオサイト共有プラットフォーム</span><br>
    </div>
    <img src="/img/hero_banner1.jpg" width="1200" height="600" alt="ポートフォリオネットワーク">
  </section>
  <section class="OSCSS-section-latest">
    <div class="OSCSS-section-inner">
      <h2 class="animate-box-up">新着ポートフォリオ</h2>
      <div class="OSCSS-section-latest-list">
        @foreach($portfolios as $portfolio)
        <a href="{{route('viewPortfolio', ['id' => $portfolio->id])}}">
          <div class="OSCSS-section-latest-col animate-box-up">
	    <div class="OSCSS-section-latest-col-pic">
              @if ($portfolio->icon_path == null)
              <img src="{{ asset('img/defaultPortfolioIcon.png') }}" width="300" height="200" alt="{{$portfolio->title}}"/>
              @else
              <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" width="150" height="150" alt="{{$portfolio->title}}"/>
              @endif
            </div>
            <div class="OSCSS-section-latest-col-desc">
              <span class="OSCSS-section-latest-col-type" style="background-color:{{$portfolioColors[$portfolio->type]}};">{{$portfolioTypes[$portfolio->type]}}</span>
            </div>
          </div>
        </a>
        @endforeach
	<a id="OSCSS-portfolio-prev">&#10094;</a>
	<a id="OSCSS-portfolio-next">&#10095;</a>
      </div>
    </div>  
  </section>
  <section class="OSCSS-section-description">
    <div class="OSCSS-section-inner">
      <h2 class="animate-box-up">Portifolio Networkとは</h2>
      <div class="OSCSS-section-description-content animate-box-up">
	<p><span style="display: inline-block;">Portifolio Network</span><span style="display: inline-block;">（ピーネット）</span>は、みんなの<span style="display: inline-block;">ポートフォリオサイト</span>をよりたくさんの人に見られるための<span style="display: inline-block;">共有プラットフォーム</span>です。</p>
      </div>
      <h2 class="animate-box-up">ポートフォリオ募集中</h2>
      <div class="OSCSS-columns animate-box-up">
        <div class="OSCSS-columns-col">
          <div class="OSCSS-columns-col-title"><p>Webデザイナー</p></div>
          <div class="OSCSS-columns-col-img"><img src="/img/Webデザイナー.png" width="100" height="100" alt="Webデザイナー"></div>
          <div class="OSCSS-columns-col-desc"><p><span style="display: inline-block;">Webデザイナー</span>の活動において、ポートフォリオは欠かせません。作品はもちろん、センスも見えてくる。せっかく作ったポートフォリオ、就職や面接しただけで役目を終わらせたくない。</p></div>
          <a class="OSCSS-columns-btn" href="{{route('register')}}">今すぐ登録</a>
        </div>
        <div class="OSCSS-columns-col">
          <div class="OSCSS-columns-col-title"><p>CGクリエーター</p></div>
          <div class="OSCSS-columns-col-img"><img src="/img/CGデザイナー.png" width="100" height="100" alt="CGデザイナー"></div>
          <div class="OSCSS-columns-col-desc"><p>NFTの登場により人気急上昇する<span style="display: inline-block;">CGクリエーター</span>、大金を稼ぐのポテンシャルはYOUTUBER超え。NFT投資者の観点から制作者の成長がとても重要。ポートフォリオサイトをたくさんの人に見てもらい、注目度アップをねらいたい。</p></div>
          <a class="OSCSS-columns-btn" href="{{route('register')}}">今すぐ登録</a>
        </div>
        <div class="OSCSS-columns-col">
          <div class="OSCSS-columns-col-title"><p>イラストレーター</p></div>
          <div class="OSCSS-columns-col-img"><img src="/img/イラストレーター.png" width="100" height="100" alt="イラストレーター"></div>
          <div class="OSCSS-columns-col-desc"><p>2021年人気職業ランキング常に上位の<span style="display: inline-block;">イラストレーター</span>。雑誌表紙、挿し絵、書籍カバー、仕事は多岐にわたるがSPOTが多い。作品をサイトにまとめ、次の仕事につなぎたい。</p></div>
          <a class="OSCSS-columns-btn" href="{{route('register')}}">今すぐ登録</a>
        </div>
        <div class="OSCSS-columns-col">
          <div class="OSCSS-columns-col-title"><p>エンジニア</p></div>
          <div class="OSCSS-columns-col-img"><img src="/img/ゲームクリエイター.png" width="100" height="100" alt="ゲームクリエイター"></div>
          <div class="OSCSS-columns-col-desc"><p>フロントエンド、マークアップ、サーバーサイド、システム、データベース、エンジニアのひとことでは説明しつくせないスキルのリスト。フルスタックとなればなおさら、言葉ではなくポートフォリオ見てほしい。</p></div>
          <a class="OSCSS-columns-btn" href="{{route('register')}}">今すぐ登録</a>
        </div>
        <div class="OSCSS-columns-col">
          <div class="OSCSS-columns-col-title"><p>Webディレクター</p></div>
          <div class="OSCSS-columns-col-img"><img src="/img/ディレクター.png" width="100" height="100" alt="ディレクター"></div>
          <div class="OSCSS-columns-col-desc"><p>デザイナーでもない、エンジニアでもないけど、あれもこれも実はできる<span style="display: inline-block;">Webディレクター</span>。プロジェクトをリストアップして、職務経歴書作っても、ポートフォリオは採用の決め手。なんならサイト見てスカウトしてほしい。</p></div>
          <a class="OSCSS-columns-btn" href="{{route('register')}}">今すぐ登録</a>
        </div>
        <div class="OSCSS-columns-col">
          <div class="OSCSS-columns-col-title"><p>コピーライター</p></div>
          <div class="OSCSS-columns-col-img"><img src="/img/コピーライター.png" width="100" height="100" alt="コピーライター"></div>
          <div class="OSCSS-columns-col-desc"><p>副業ブームの今、<span style="display: inline-block;">コピーライター</span>が増えています。アマチュアと差別化して、仕事獲得するにはやはりポートフォリオ。自分の作品をもっと見てもらいたい。</p></div>
          <a class="OSCSS-columns-btn" href="{{route('register')}}">今すぐ登録</a>
        </div>
	<a id="OSCSS-prev">&#10094;</a>
	<a id="OSCSS-next">&#10095;</a>
      </div>
    </div>
  </section>
</div>
@endsection

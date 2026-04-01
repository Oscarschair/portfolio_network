@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/welcome.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('js/welcome.js') }}?v={{ time() }}" defer></script>

<div class="OSCSS-main-container">
  <section class="OSCSS-section-hero">
    <div class="OSCSS-hero-overlay"></div>
    <div class="OSCSS-section-hero-content animate-box-up">
      <h1 class="OSCSS-hero-title">チャンスは準備された心に降り立つ</h1>
      <p class="OSCSS-hero-subtitle">Portfolio Network</p>
      <div class="OSCSS-hero-badge">ポートフォリオ共有プラットフォーム</div>
    </div>
  </section>

  <section class="OSCSS-section-latest">
    <div class="OSCSS-section-inner">
      <div class="OSCSS-section-header">
        <h2 class="OSCSS-section-title animate-box-up">新着ポートフォリオ</h2>
        <div class="OSCSS-section-line"></div>
      </div>
      <div class="OSCSS-section-latest-list-wrapper">
        <div class="OSCSS-section-latest-list">
          @foreach($portfolios as $portfolio)
          <a href="{{route('viewPortfolio', ['id' => $portfolio->id])}}" class="OSCSS-portfolio-card-link">
            <div class="OSCSS-section-latest-col animate-box-up">
              <div class="OSCSS-section-latest-col-pic">
                @if ($portfolio->icon_path == null)
                <img class="OSCSS-section-latest-col-pic-img" src="{{ asset('img/defaultPortfolioIcon.png') }}" alt="{{$portfolio->title}}"/>
                @else
                <img class="OSCSS-section-latest-col-pic-img" src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" alt="{{$portfolio->title}}"/>
                @endif
              </div>
              <div class="OSCSS-card-glow"></div>
            </div>
          </a>
          @endforeach
        </div>
        <button id="OSCSS-portfolio-prev" class="OSCSS-nav-btn" aria-label="Previous">&#10094;</button>
        <button id="OSCSS-portfolio-next" class="OSCSS-nav-btn" aria-label="Next">&#10095;</button>
      </div>
    </div>  
  </section>

  <section class="OSCSS-section-description">
    <div class="OSCSS-section-inner">
      <div class="OSCSS-description-card animate-box-up">
        <h2>Portfolio Networkとは</h2>
        <div class="OSCSS-section-description-content">
          <p><span>Portfolio Network</span>（ピーネット）は、みんなの<span>ポートフォリオサイト</span>をよりたくさんの人に見られるための<span>共有プラットフォーム</span>です。</p>
        </div>
      </div>

      <div class="OSCSS-section-header margin-top-lg">
        <h2 class="OSCSS-section-title animate-box-up">ポートフォリオ募集中</h2>
        <div class="OSCSS-section-line"></div>
      </div>

      <div class="OSCSS-columns-wrapper">
        <div class="OSCSS-columns animate-box-up">
          @php
            $categories = [
              ['name' => 'Webデザイナー', 'img' => 'Webデザイナー.png', 'desc' => '作品はもちろん、センスも見えてくる重要ツール。ポートフォリオの役目を最大化しましょう。'],
              ['name' => 'CGクリエーター', 'img' => 'CGデザイナー.png', 'desc' => 'NFTやデジタルアートの最前線へ。注目度アップとキャリアの成長を狙いたい方に。'],
              ['name' => 'イラストレーター', 'img' => 'イラストレーター.png', 'desc' => '表紙からWEB素材まで、多彩な作品をひとまとめに。次の仕事への架け橋に。'],
              ['name' => 'エンジニア', 'img' => 'ゲームクリエイター.png', 'desc' => '言葉ではなくコードで、成果物で語る。フルスタックスキルを可視化。'],
              ['name' => 'Webディレクター', 'img' => 'ディレクター.png', 'desc' => 'プロジェクトの軌跡をポートフォリオに。採用の決め手となる実績をアピール。'],
              ['name' => 'コピーライター', 'img' => 'コピーライター.png', 'desc' => '言葉の力を作品として集約。アマチュアと差別化し、信頼を獲得する。']
            ];
          @endphp

          @foreach($categories as $cat)
          <div class="OSCSS-columns-col">
            <div class="OSCSS-columns-col-title"><h3>{{ $cat['name'] }}</h3></div>
            <div class="OSCSS-columns-col-img">
              <img src="/img/{{ $cat['img'] }}" width="80" height="80" alt="{{ $cat['name'] }}">
            </div>
            <div class="OSCSS-columns-col-desc"><p>{{ $cat['desc'] }}</p></div>
            <a class="OSCSS-columns-btn" href="{{route('register')}}">今すぐ登録</a>
          </div>
          @endforeach
        </div>
        <button id="OSCSS-prev" class="OSCSS-nav-btn">&#10094;</button>
        <button id="OSCSS-next" class="OSCSS-nav-btn">&#10095;</button>
      </div>
    </div>
  </section>

</div>
@endsection

@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/welcome.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('js/welcome.js') }}?v={{ time() }}" defer></script>

<div class="OSCSS-main-container">
  <section class="OSCSS-section-hero">
    <div class="OSCSS-hero-overlay"></div>
    <div class="OSCSS-hero-floating-elements"></div>
    <div class="OSCSS-section-hero-content animate-box-up">
      <h1 class="OSCSS-hero-title">あなたの才能を埋もれさせない。<br>ポートフォリオを通じてあなたを売り出そう。</h1>
      <p class="OSCSS-hero-subtitle">SNSのタイムラインで流されてしまうには、あなたの作品は惜しすぎる。<br>自分だけの拠点（HP）を持ち、プロとしての信頼を世界に示しましょう。</p>
      <div class="OSCSS-hero-badge">Portfolio Network</div>

      <div class="OSCSS-description-card hero-overlay-card">
        <h2>「売り出す」をカタチにする</h2>
        <div class="OSCSS-section-description-content">
          <p><span>Portfolio Network</span>は、クリエイターが単に作品を置くだけでなく、<span>「見つかり、伝わり、繋がる」</span>ための戦略的な共有プラットフォームです。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="OSCSS-section-latest">
    <div class="OSCSS-section-inner">
      <div class="OSCSS-section-header">
        <h2 class="OSCSS-section-title animate-box-up">
          <span class="OSCSS-live-badge">LIVE</span>
          新着の才能
        </h2>
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

      <div class="OSCSS-section-header margin-top-lg">
        <h2 class="OSCSS-section-title animate-box-up">「売り出す」を具体化する3つの柱</h2>
        <div class="OSCSS-section-line"></div>
      </div>

      <div class="OSCSS-columns-wrapper">
        <div class="OSCSS-columns animate-box-up">
          <div class="OSCSS-columns-col pillar-card">
            <div class="OSCSS-columns-col-title"><h3>「見つかる」プラットフォーム</h3></div>
            <div class="OSCSS-columns-col-img">
              <i class="OSCSS-pillar-icon search-glow"></i>
            </div>
            <div class="OSCSS-columns-col-desc">
              <p>単なるリンク集ではなく、クライアントや採用担当者が「才能を探す場所」として機能します。</p>
            </div>
          </div>

          <div class="OSCSS-columns-col pillar-card highlighted">
            <div class="OSCSS-columns-col-title"><h3>「伝わる」ポートフォリオ</h3></div>
            <div class="OSCSS-columns-col-img">
              <i class="OSCSS-pillar-icon presentation-glow"></i>
            </div>
            <div class="OSCSS-columns-col-desc">
              <p>SNSでは表現しきれない、制作の背景やあなたのスキルセットを体系的に見せることができます。</p>
            </div>
          </div>

          <div class="OSCSS-columns-col pillar-card">
            <div class="OSCSS-columns-col-title"><h3>「繋がる」チャンス</h3></div>
            <div class="OSCSS-columns-col-img">
              <i class="OSCSS-pillar-icon connection-glow"></i>
            </div>
            <div class="OSCSS-columns-col-desc">
              <p>登録したHPがあなたの24時間365日の営業マンとなり、新しい仕事の窓口になります。</p>
            </div>
          </div>
        </div>
        
        <div class="OSCSS-cta-wrapper animate-box-up">
          <a class="OSCSS-columns-btn cta-large" href="{{route('register')}}">今すぐあなたの才能を登録する</a>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection

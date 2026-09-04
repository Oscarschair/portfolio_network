@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/welcome.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('js/welcome.js') }}?v={{ time() }}" defer></script>

<div class="OSCSS-main-container">
  <!-- Hero Section -->
  <section class="OSCSS-section-hero">
    <div class="OSCSS-hero-overlay"></div>
    <div class="OSCSS-hero-floating-elements">
      <div class="glow-orb orb-1"></div>
      <div class="glow-orb orb-2"></div>
    </div>
    
    <div class="OSCSS-section-hero-content animate-box-up">
      <div class="hero-badge-pill">
        <span class="badge-dot"></span>
        <span>クリエイターのためのポートフォリオ共有基盤</span>
      </div>
      
      <h1 class="OSCSS-hero-title">
        あなたの才能を、埋もれさせない。<br>
        <span class="text-gradient">ポートフォリオ</span>で世界と繋がろう。
      </h1>
      
      <p class="OSCSS-hero-subtitle">
        SNSのタイムラインで流されてしまうには、あなたの作品は惜しすぎる。<br>
        独自ドメインや自作HPを登録し、プロとしての信頼と実績を届けましょう。
      </p>

      <div class="hero-cta-group">
        <a class="btn-modern-primary btn-hero-cta" href="{{ route('register') }}">
          今すぐポートフォリオを登録（無料）
        </a>
        <a class="btn-modern-secondary btn-hero-sub" href="#categories">
          クリエイターを探す
        </a>
      </div>

      <!-- Quick Search Bar inside Hero -->
      <div class="hero-search-box">
        <form action="{{ route('globalSearch') }}" method="post">
          @csrf
          <div class="hero-search-inner">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input name="keyword" type="text" placeholder="職種・スキル・クリエイター名で検索..." autocomplete="off">
            <button type="submit" class="btn-hero-search">検索</button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Category Pills Section -->
  <section id="categories" class="OSCSS-section-categories">
    <div class="OSCSS-section-inner">
      <div class="category-pills-wrapper">
        <span class="category-label">職種から探す:</span>
        <div class="category-pills">
          @if(isset($portfolioTypes))
            @foreach($portfolioTypes as $index => $type)
              <form action="{{ route('globalSearch') }}" method="post" style="display:inline;">
                @csrf
                <input type="hidden" name="type" value="{{ $index }}">
                <button type="submit" class="category-pill-btn">{{ $type }}</button>
              </form>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- Latest Portfolios Section -->
  <section class="OSCSS-section-latest">
    <div class="OSCSS-section-inner">
      <div class="OSCSS-section-header">
        <div class="header-tag">
          <span class="pulse-dot"></span>
          <span>DISCOVER TALENTS</span>
        </div>
        <h2 class="OSCSS-section-title">新着の才能</h2>
        <p class="section-subtitle">世界中のクライアントへ発信中の最新ポートフォリオ</p>
      </div>

      <div class="OSCSS-section-latest-list-wrapper">
        @if(count($portfolios) > 0)
          <div class="OSCSS-section-latest-list">
            @foreach($portfolios as $portfolio)
            <a href="{{ route('viewPortfolio', ['id' => $portfolio->id]) }}" class="OSCSS-portfolio-card-link">
              <div class="OSCSS-section-latest-col">
                <div class="OSCSS-section-latest-col-pic">
                  @if ($portfolio->icon_path == null)
                    <img class="OSCSS-section-latest-col-pic-img" src="{{ asset('img/defaultPortfolioIcon.png') }}" alt="{{ $portfolio->title ?? 'Portfolio' }}"/>
                  @else
                    <img class="OSCSS-section-latest-col-pic-img" src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" alt="{{ $portfolio->title ?? 'Portfolio' }}"/>
                  @endif
                </div>
                <div class="portfolio-card-info">
                  <span class="portfolio-type-badge">{{ $portfolio->type ?? 'クリエイター' }}</span>
                  <h3 class="portfolio-card-title">{{ $portfolio->title ?? '名称未設定' }}</h3>
                  @if($portfolio->description)
                    <p class="portfolio-card-desc">{{ Str::limit($portfolio->description, 60) }}</p>
                  @endif
                </div>
              </div>
            </a>
            @endforeach
          </div>
        @else
          <div class="empty-state-card">
            <p>現在新着ポートフォリオを準備中です。最初のクリエイターになりましょう！</p>
            <a href="{{ route('register') }}" class="btn-modern-primary" style="margin-top: 16px;">ポートフォリオを登録する</a>
          </div>
        @endif
      </div>
    </div>  
  </section>

  <!-- 3 Pillars Section -->
  <section class="OSCSS-section-description">
    <div class="OSCSS-section-inner">
      <div class="OSCSS-section-header">
        <div class="header-tag">
          <span>OUR STRATEGY</span>
        </div>
        <h2 class="OSCSS-section-title">「売り出す」を具体化する3つの柱</h2>
        <p class="section-subtitle">単なるリンク集ではない、成果に直結するポートフォリオ活用</p>
      </div>

      <div class="OSCSS-columns-wrapper">
        <div class="OSCSS-columns">
          <div class="OSCSS-columns-col pillar-card">
            <div class="pillar-icon-box icon-search">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <div class="OSCSS-columns-col-title">
              <h3>「見つかる」プラットフォーム</h3>
            </div>
            <div class="OSCSS-columns-col-desc">
              <p>職種・スキル別に最適化された検索構造により、クライアントや採用担当者が求めるピンポイントな才能として見つけ出されます。</p>
            </div>
          </div>

          <div class="OSCSS-columns-col pillar-card">
            <div class="pillar-icon-box icon-presentation">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h20M4 3v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3M10 9l5 3-5 3V9z"></path></svg>
            </div>
            <div class="OSCSS-columns-col-title">
              <h3>「伝わる」ポートフォリオ</h3>
            </div>
            <div class="OSCSS-columns-col-desc">
              <p>SNSでは流れてしまう制作背景やデザイン思想、スキルスタックを自分のWebサイトで体系的に証明。プロとしての信頼を獲得します。</p>
            </div>
          </div>

          <div class="OSCSS-columns-col pillar-card">
            <div class="pillar-icon-box icon-connection">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="OSCSS-columns-col-title">
              <h3>「繋がる」チャンス</h3>
            </div>
            <div class="OSCSS-columns-col-desc">
              <p>あなたの自作HPが24時間365日働く営業拠点となり、直契約の案件獲得や新規コラボレーションの窓口として機能します。</p>
            </div>
          </div>
        </div>
        
        <div class="OSCSS-cta-banner">
          <div class="cta-banner-content">
            <h3>あなたの作品と才能を、今すぐ登録しませんか？</h3>
            <p>わずか1分で登録完了。所有者認証を通じて、本物の信頼をクリエイティブに。</p>
          </div>
          <a class="btn-modern-primary btn-cta-banner" href="{{ route('register') }}">無料アカウントを作成する</a>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

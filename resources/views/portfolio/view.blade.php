@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/portfolio.css') }}?v={{ time() }}" rel="stylesheet">
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v12.0" nonce="CNjaHHdJ"></script>

@if($urlClicked)
<script>window.open('{{$urlClicked}}', '_blank')</script>
@endif

<div class="container">
    <div class="justify-content-center">
      @if ($portfolio->display_flag && $portfolio->verified_at)
      <div class="portfolio-detail-card animate-box-up">
        
        <!-- Hero & Metrics Area -->
        <div class="portfolio-hero-section">
          <div class="portfolio-preview-wrap">
            @if ($portfolio->icon_path == null)
              <img src="{{ asset('img/defaultPortfolioIcon.png') }}" alt="{{$portfolio->title}}"/>
            @else
              <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" alt="{{$portfolio->title}}"/>
            @endif
          </div>

          <div class="portfolio-stats-group">
            <div class="portfolio-badge-row">
              <span class="portfolio-type-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                {{ $portfolioTypes[$portfolio->type] ?? 'Webサイト' }}
              </span>
            </div>

            <h1 class="portfolio-main-title">{{ $portfolio->title }}</h1>

            <div class="metrics-row">
              <div class="metric-pill">
                <span class="metric-val">{{ number_format($portfolio->view) }}</span>
                <span class="metric-lbl">Total Views</span>
              </div>
              <div class="metric-pill">
                <span class="metric-val">{{ number_format($portfolio->click) }}</span>
                <span class="metric-lbl">Total Clicks</span>
              </div>
            </div>

            <div>
              <form action="{{ route('clickPortfolio', ['id' => $portfolio->id])}}" id="clickPortfolio" method="post" target="_blank" style="margin: 0;">
                @csrf
                <input type="hidden" name="urlClicked" value="{{$portfolio->url}}">
                <button type="submit" class="visit-site-cta">
                  <span>サイトを訪問する</span>
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- Details List -->
        <div class="portfolio-details-list">
          <div class="portfolio-detail-row">
            <div class="portfolio-detail-label">クリエイター</div>
            <div class="portfolio-detail-value">
              <a href="{{ route('viewProfile', ['id' => $user->id]) }}" class="portfolio-author-box">
                <div class="author-avatar">
                  @if ($user->icon_path == null)
                    <img src="{{ asset('img/defaultProfileIcon.png') }}" alt="{{$user->name}}"/>
                  @else
                    <img src="{{ asset('userimages/'.$user->icon_path) }}" alt="{{$user->name}}"/>
                  @endif
                </div>
                <span class="author-name">{{ $user->name }}</span>
              </a>
            </div>
          </div>

          <div class="portfolio-detail-row">
            <div class="portfolio-detail-label">URL</div>
            <div class="portfolio-detail-value">
              <a href="{{ $portfolio->url }}" target="_blank" rel="noopener noreferrer" style="color: var(--primary, #6366f1); text-decoration: underline; word-break: break-all;">
                {{ $portfolio->url }}
              </a>
            </div>
          </div>

          <div class="portfolio-detail-row">
            <div class="portfolio-detail-label">詳細説明</div>
            <div class="portfolio-detail-value" style="white-space: pre-line;">
              {{ $portfolio->description }}
            </div>
          </div>
        </div>

        <!-- Social Share -->
        <div class="portfolio-share-bar">
          <div class="share-bar-title">このポートフォリオをシェアする</div>
          <div class="share-buttons">
            <a href="https://twitter.com/share?url={{ urlencode(url()->current()) }}&text={{ urlencode($portfolio->title . ' | Portfolio Network') }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm" style="display: inline-flex; align-items: center; gap: 6px;">
              <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
              <span>ポスト</span>
            </a>
            <div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button" data-size="large"></div>
          </div>
        </div>

      </div>
      @else
      <div class="portfolio-detail-card" style="text-align: center; padding: 60px 20px;">
        <div style="font-size: 2.5rem; margin-bottom: 16px;">🔒</div>
        <h3 style="color: var(--text-primary, #f8fafc); margin-bottom: 8px;">非公開ポートフォリオ</h3>
        <p style="color: var(--text-muted, #94a3b8);">このポートフォリオは現在非公開、または所有者認証待ちです。</p>
        <div style="margin-top: 24px;">
          <a href="{{ route('welcome') }}" class="btn btn-primary">トップへ戻る</a>
        </div>
      </div>
      @endif
    </div>
</div>
@endsection

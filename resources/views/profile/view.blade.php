@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/myprofile.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('css/welcome.css') }}?v={{ time() }}" rel="stylesheet">

<div class="container">
    <div class="justify-content-center">
      
      <!-- Creator Profile Card -->
      <div class="myprofile-card animate-box-up">
        <div class="profile-header-flex">
          <div class="profile-avatar-wrap">
            @if ($user->icon_path == null)
              <img src="{{ asset('img/defaultProfileIcon.png') }}" alt="{{$user->name}}"/>
            @else
              <img src="{{ asset('userimages/'.$user->icon_path) }}" alt="{{$user->name}}"/>
            @endif
          </div>
          <div class="profile-info-content">
            <h1 class="profile-name">{{ $user->name }}</h1>
            <p class="profile-desc">
              {{ $user->description ?: '自己紹介はまだ設定されていません。' }}
            </p>
          </div>
        </div>
      </div>

      <!-- Published Portfolios Grid -->
      <div class="myprofile-card animate-box-up" style="margin-top: 24px;">
        <div class="dashboard-section-header">
          <h2 class="dashboard-section-title">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
            登録ポートフォリオ一覧
          </h2>
        </div>

        @php
          $publicPortfolios = $portfolios->filter(function($p) {
              return $p->verified_at != null && $p->display_flag;
          });
        @endphp

        @if ($publicPortfolios->count() > 0)
          <div class="recent-portfolios-grid" style="margin-top: 16px;">
            @foreach ($publicPortfolios as $portfolio)
              <a href="{{ route('viewPortfolio', ['id' => $portfolio->id]) }}" class="portfolio-card">
                <div class="portfolio-card-thumb">
                  @if ($portfolio->icon_path == null)
                    <img src="{{ asset('img/defaultPortfolioIcon.png') }}" alt="{{$portfolio->title}}" loading="lazy"/>
                  @else
                    <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" alt="{{$portfolio->title}}" loading="lazy"/>
                  @endif
                  <span class="portfolio-card-badge">{{ $portfolioTypes[$portfolio->type] ?? 'Webサイト' }}</span>
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">{{ $portfolio->title }}</h3>
                  <p class="portfolio-card-desc">{{ $portfolio->description }}</p>
                  <div class="portfolio-card-footer">
                    <span class="portfolio-card-user">{{ $user->name }}</span>
                    <span class="portfolio-card-views">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                      {{ number_format($portfolio->view) }}
                    </span>
                  </div>
                </div>
              </a>
            @endforeach
          </div>
        @else
          <div class="empty-state-card" style="padding: 40px 20px; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 12px;">📁</div>
            <p style="color: var(--text-muted, #94a3b8);">現在公開中のポートフォリオはありません。</p>
          </div>
        @endif
      </div>

    </div>
</div>
@endsection

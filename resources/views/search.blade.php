@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/search.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('js/search.js') }}?v={{ time() }}" defer></script>

<div class="search-page-wrapper">
  <div class="OSCSS-section-inner">
    
    <!-- Search Filter Box -->
    <div class="search-filter-box animate-box-up">
      <form action="{{ route('globalSearch') }}" id="searcher" method="get" class="search-filter-form">
        <div class="search-input-wrapper">
          <svg class="search-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
          <input name="keyword" type="text" id="keyword" value="{{ $keyword ?? '' }}" placeholder="キーワードで検索（スキル、クリエイター名など）" autocomplete="off">
        </div>
        
        <div class="search-select-wrapper">
          <select name="type" id="portfolioType">
            <option value="999">すべての職種</option>
            @if(isset($portfolioTypes))
              @for($i = 0; $i < count($portfolioTypes); $i++)
                <option value="{{ $i }}" {{ (isset($type) && $i == $type) ? 'selected' : '' }}>{{ $portfolioTypes[$i] }}</option>
              @endfor
            @endif
          </select>
        </div>
        
        <button type="submit" class="btn-search-submit">絞り込み検索</button>
      </form>
    </div>

    <!-- Results Header -->
    <div class="search-results-header animate-box-up">
      <h2 class="search-results-count">
        検索結果: <span>{{ $portfolios->total() }}</span> 件
      </h2>
    </div>

    <!-- Card Grid -->
    @if($portfolios->count() > 0)
      <div class="search-card-grid">
        @foreach($portfolios as $portfolio)
          <a href="{{ route('viewPortfolio', ['id' => $portfolio->id]) }}" class="search-card animate-box-up">
            <div class="search-card-thumb">
              @if ($portfolio->icon_path == null)
                <img src="{{ asset('img/defaultPortfolioIcon.png') }}" alt="{{ $portfolio->title ?? 'Portfolio' }}"/>
              @else
                <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" alt="{{ $portfolio->title ?? 'Portfolio' }}"/>
              @endif
            </div>
            <div class="search-card-body">
              <span class="search-card-type">{{ $portfolio->type ?? 'クリエイター' }}</span>
              <h3 class="search-card-title">{{ $portfolio->title ?? '名称未設定' }}</h3>
              @if($portfolio->description)
                <p class="search-card-desc">{{ Str::limit($portfolio->description, 70) }}</p>
              @endif
            </div>
          </a>
        @endforeach
      </div>
      
      <!-- Pagination -->
      <div class="search-pagination animate-box-up">
        {{ $portfolios->appends(['keyword' => $keyword ?? '', 'type' => $type ?? 999])->onEachSide(1)->links('pagination.pc') }}
      </div>
    @else
      <div class="search-empty-state animate-box-up">
        <div class="search-empty-icon">🔍</div>
        <p>該当するポートフォリオは見つかりませんでした。<br>別のキーワードや職種で検索してみてください。</p>
      </div>
    @endif

  </div>
</div>
@endsection

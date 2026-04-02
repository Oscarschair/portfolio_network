@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/search.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('js/search.js') }}?v={{ time() }}" defer></script>

<div class="OSCSS-section-inner">
  <div class="OSCSS-content-box-wrapper margin-top-lg">
    
    <div id="OSCSS-content-searcher" class="animate-box-up">
      <form action="{{route('globalSearch')}}" id="searcher" method="get">
        <input name="keyword" class="c-text-input" type="text" id="keyword" value="{{$keyword}}" placeholder="キーワードで検索" autocomplete="off">
        <select name="type" class="select" id="portfolioType">
          <option value="999">すべての職種</option>
          @for($i = 0; $i < Count($portfolioTypes); $i++)
            <option value="{{$i}}" {{ $i == $type ? 'selected' : '' }}>{{$portfolioTypes[$i]}}</option>
          @endfor
        </select>
        <button type="submit" class="btn-primary">検索</button>
      </form>
    </div>

    <div class="OSCSS-content-header animate-box-up">
      <h2>検索結果: {{ $portfolios->total() }} 件</h2>
      <div class="OSCSS-content-header-nav pc-only">
        {{$portfolios->appends(['keyword' => $keyword, 'type' => $type])->onEachSide(1)->links('pagination.pc')}}
      </div>
    </div>

    @if($portfolios->count() > 0)
      <div class="OSCSS-section-search-list">
        @foreach($portfolios as $portfolio)
          <div class="OSCSS-section-search-col animate-box-up">
            <a href="{{route('viewPortfolio', ['id' => $portfolio->id])}}" class="OSCSS-search-card-link">
              <div class="OSCSS-section-search-col-pic">
                @if ($portfolio->icon_path == null)
                  <img src="{{ asset('img/defaultPortfolioIcon.png') }}" alt="{{$portfolio->title}}"/>
                @else
                  <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" alt="{{$portfolio->title}}"/>
                @endif
              </div>
              <div class="OSCSS-section-search-col-desc">
                <span class="OSCSS-section-search-col-type" style="background-color:{{$portfolioColors[$portfolio->type]}};">{{$portfolioTypes[$portfolio->type]}}</span>
                <span class="OSCSS-section-search-col-title">{{$portfolio->title}}</span>
              </div>
            </a>
          </div>
        @endforeach
      </div>
      
      <div class="OSCSS-content-bottom-pagin animate-box-up">
        {{$portfolios->appends(['keyword' => $keyword, 'type' => $type])->onEachSide(1)->links('pagination.pc')}}
      </div>
    @else
      <div class="OSCSS-no-results animate-box-up">
        <div class="OSCSS-no-results-icon">🔍</div>
        <p>該当するポートフォリオは見つかりませんでした。<br>別のキーワードや職種で試してみてください。</p>
      </div>
    @endif

  </div>
</div>
@endsection

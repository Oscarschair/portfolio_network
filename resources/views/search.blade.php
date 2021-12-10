@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/search.css') }}" rel="stylesheet">
<script src="{{ asset('js/search.js') }}" defer></script>
<div class="container">
<div class="justify-content-center">
  <div class="OSCSS-content-box">
    <div class="OSCSS-content-box-inner">
      <div id="OSCSS-content-searcher">
        <form action="{{route('globalSearch')}}" id="searcher" method="get" enctype="multipart/form-data">
          @csrf
          <input name="keyword" class="c-text-input" type="text" id="keyword" value="{{$keyword}}" autocomplete="off">
          <select name="type" class="select" id="portfolioType">
            <option value="999">すべて</option>
            @for($i = 0; $i < Count($portfolioTypes); $i++)
              @if ($i == $type)
              <option value="{{$i}}" selected>{{$portfolioTypes[$i]}}</option>
              @else
              <option value="{{$i}}">{{$portfolioTypes[$i]}}</option>
              @endif
            @endfor
          </select>
          <input name="submit" class="btn btn-primary" type="submit" value="検索">
        </form>
      </div>
      <div class="OSCSS-content-header">
        <h2 class="animate-box-up">検索結果 {{$portfolios->total()}} 件</h2>
        <div class="OSCSS-content-header-nav animate-box-up pc-only">
          {{$portfolios->appends(['keyword' => $keyword])->onEachSide(1)->links('pagination.pc')}}
        </div>
        <div class="OSCSS-content-header-nav animate-box-up sp-only">
          {{$portfolios->appends(['keyword' => $keyword])->onEachSide(1)->links('pagination.sp')}}
        </div>
      </div>
      <hr>
      <div class="OSCSS-section-search-list">
        @foreach($portfolios as $portfolio)
          <div class="OSCSS-section-search-col animate-box-up">
        <a href="{{route('viewPortfolio', ['id' => $portfolio->id])}}">
	    <div class="OSCSS-section-search-col-pic">
              @if ($portfolio->icon_path == null)
              <img src="{{ asset('img/defaultPortfolioIcon.png') }}" width="150" height="100" alt="{{$portfolio->title}}"/>
              @else
              <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" width="150" height="100" alt="{{$portfolio->title}}"/>
              @endif
            </div>
        </a>
            <div class="OSCSS-section-search-col-desc">
              <span class="OSCSS-section-search-col-type" style="background-color:{{$portfolioColors[$portfolio->type]}};">{{$portfolioTypes[$portfolio->type]}}</span><br>
              <span class="OSCSS-section-search-col-title">タイトル： {{$portfolio->title}}</span>
            </div>
          </div>
        @endforeach
      </div>
      <div class="OSCSS-content-bottom-pagin">
        <div class="OSCSS-content-header-nav animate-box-up pc-only">
          {{$portfolios->appends(['keyword' => $keyword])->onEachSide(1)->links('pagination.pc')}}
        </div>
        <div class="OSCSS-content-header-nav animate-box-up sp-only">
          {{$portfolios->appends(['keyword' => $keyword])->onEachSide(1)->links('pagination.sp')}}
        </div>
      </div>
    </div>  
  </div>
</div>
</div>
@endsection

@inject('CommonLib', 'App\Libs\CommonLib')
{{$CommonLib->get_info()}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    {{-- OGPを設定 --}}
    @if (Request::is('/'))<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
    <meta property="og:type" content="website" />
    @else
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta property="og:type" content="article" />
    @endif
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <link rel="canonical" href="{{URL::current()}}">

    @isset($title)<title>{{ $title }}</title>
    @else<title>{{ config('app.name', 'Laravel') }}</title>
    @endisset

    @isset($meta_description)<meta content="{{$meta_description}}" name='description'>
    @else<meta content="{{ config('app.description', 'description') }}" name='description'>
    @endisset
@isset($meta_keywords)<meta content="{{$meta_keywords}}" name='keywords'>
    @else<meta content="Portifolio,Network,ポートフォリオ,共有,プラットフォーム" name='keywords'>
    @endisset

    <meta property="og:url" content="{{ \Request::fullUrl() }}" />
    @isset($title)<meta property="og:title" content="{{ $title }}" />
    @else<meta property="og:title" content="{{ config('app.name', 'Portifolio Network') }}" />
    @endisset
@isset($meta_description)<meta property="og:description" content="{{$meta_description}}" />
    @else<meta property="og:description" content="あなたの才能は秘めたままにしないポートフォリオ共有プラットフォーム">
    @endisset<meta property="og:site_name" content="Portifolio Network" />
    @isset($meta_image_path)
    <meta property="og:image" content="{{$meta_image_path}}" />
    @else<meta property="og:image" content="{{asset('img/logo.png')}}" />
    @endisset
    
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@ChairOscar" />
    {{-- OGPを設定 end --}}
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}" ></script>
    <script src="{{ asset('js/common.js') }}" defer></script>
    <script src="{{ asset('js/header.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?<?php echo date('Ymd-Hi'); ?>" type="text/css">
    {{-- <link href="{{ asset('FontAwesome/css/all.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/header.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">



    <!-- fullcalendar -->
    {{-- <link href="{{ asset('fullcalendar/core/main.min.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/daygrid/main.min.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/timegrid/main.min.css') }}" rel='stylesheet' />
    <script src="{{ asset('fullcalendar/core/main.min.js') }}"></script>
    <script src="{{ asset('fullcalendar/daygrid/main.min.js') }}"></script>
    <script src="{{ asset('fullcalendar/interaction/main.min.js') }}"></script>
    <script src="{{ asset('fullcalendar/timegrid/main.min.js') }}"></script> --}}

    <!-- bootstrap-datepickerを読み込む -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap-datepicker/locales/bootstrap-datepicker.ja.min.js') }}"></script> --}}

    <!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MPJ85VB');</script>
    <!-- End Google Tag Manager -->

</head>
<body>
    <!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MPJ85VB"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div id="wrapper">
      <div id="OSCSS-canvas"></div>
        <header id="header">
            <div id="header-block">
                <a class="OSCSS-brand" href="{{ url('/') }}">
                    <img id="logo" src="{{ asset('/img/logo.png') }}" width="140" height="40" alt="{{ config('app.name', 'Laravel') }}">
                </a>
		 <h1>{{ config('app.name', 'Laravel') }} {{ config('app.description', 'description') }}</h1>
		 <nav class="header-nav">
		     <div class="header-nav-closer"></div>
		     <div class="header-nav-content">
		       <a id="OSCSS-nav-search"><img src="/img/search.png" alt="検索" width="40" height="40"></a>
		       <!-- 認証前のリンク -->
		       <div class="OSCSS-nav">
		       @guest
		         <a class="OSCSS-nav-item" href="{{route('login')}}">ログイン</a>
		         <a class="OSCSS-nav-item" href="{{route('register')}}">会員登録</a>
		       <!-- 認証済みのリンク -->
		       @else
		         <a class="OSCSS-nav-item" href="{{ route('myprofile') }}"><i class="fas fa-home fa-fw"></i>マイページ</a>
		         <a class="OSCSS-nav-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
		         <i class="fas fa-sign-out-alt"></i>&nbsp;ログアウト</a>
		         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		         @csrf
		         </form>
		       @endguest
		     </div>
		     <div class="header-nav-bottom">
		         <a class="OSCSS-nav-item" href="{{ route('guide') }}">ご利用ガイド</a>
		         <a class="OSCSS-nav-item" href="{{ route('contact') }}">お問い合わせ</a>
		         <a class="OSCSS-nav-item" href="{{ route('company') }}">運営について</a>
		         <a class="OSCSS-nav-item" href="{{ route('terms') }}">ご利用規約</a>
		         <a class="OSCSS-nav-item" href="{{ route('privacypolicy') }}">プライバシーポリシー</a>
		     </div>
		     </div>
                </nav>
                
                <div class="hamburger">
		  <span></span>
		  <span></span>
		  <span></span>
		</div>
            </div>
            <div id="OSCSS-searcher">
              <form action="{{route('globalSearch')}}" id="GlobalSearcher" method="post" enctype="multipart/form-data">
                @csrf
                <input name="keyword" class="c-text-input" type="text" id="keyword" placeholder="ここから検索" autocomplete="off">
                <input name="submit" style="display:none;" type="submit" value="検索">
              </form>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <nav class="pc-only">
                    <ul>
                        <li><a class="OSCSS-footer-item" href="{{route('guide')}}">ご利用ガイド</a></li>
                        <li><a class="OSCSS-footer-item" href="{{route('contact')}}">お問い合わせ</a></li>
                        <li><a class="OSCSS-footer-item" href="{{route('company')}}">運営について</a></li>
                        <li><a class="OSCSS-footer-item" href="{{route('terms')}}">利用規約</a></li>
                        <li><a class="OSCSS-footer-item" href="{{route('privacypolicy')}}">プライバシーポリシー</a></li>
                    </ul>
                </nav>
                <nav class="sp-only">
                    <div></div>
                    <ul>
                        <li><a class="OSCSS-footer-item" href="{{route('guide')}}">ご利用ガイド</a></li>
                        <li><a class="OSCSS-footer-item" href="{{route('contact')}}">お問い合わせ</a></li>
                    </ul>
                    <ul>
                        <li><a class="OSCSS-footer-item" href="{{route('company')}}">運営について</a></li>
                        <li><a class="OSCSS-footer-item" href="{{route('terms')}}">利用規約</a></li>
                        <li><a class="OSCSS-footer-item" href="{{route('privacypolicy')}}">プライバシーポリシー</a></li>
                    </ul>
                </nav>
            </div>
            <div class="OSCSS-footer-rights">&copy; 2021 <a href="http://oscarchair.jp">OSCARCHAIR.JP</a> ALL RIGHTS RESERVED.</span>
        </footer>
    </div>
</body>
</html>

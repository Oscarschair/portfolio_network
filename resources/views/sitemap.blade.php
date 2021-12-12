<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach($uris as $uri)
    @if($uri == 'portfolio/{id}')
      @foreach($portfolios as $portfolio)
      <url>
        <loc>{{ url('portfolio')}}/{{$portfolio->id}}</loc>
        <lastmod><?php echo date('Y-m-d')?></lastmod>
      </url>
      @endforeach
    @elseif($uri == 'profile/{id}')
      @foreach($users as $user)
      <url>
        <loc>{{ url('profile')}}/{{$user->id}}</loc>
        <lastmod><?php echo date('Y-m-d')?></lastmod>
      </url>
      @endforeach
    @else
      <url>
        <loc>{{ url($uri) }}</loc>
        <lastmod><?php echo date('Y-m-d')?></lastmod>
      </url>
    @endif
  @endforeach
</urlset>

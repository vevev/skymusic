@extends('downloadlagu123.layouts.app')
@section('link')
@endsection

@section('section')

@endsection

@section('content')
<div class="main_music">
  <div class="breadcrum">
      <ol itemscope itemtype="http://schema.org/BreadcrumbList">
          <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{ route('index') }}">
                <span itemprop="name">Trang chủ</span>
              </a>
            <meta itemprop="position" content="1" />
          </li>
          <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
              <a itemprop="item" href="{{ route('music') }}">
                  <span itemprop="name">Tải nhạc hay</span>
              </a>
              <meta itemprop="position" content="2" />
          </li>
      </ol>
  </div>
    @foreach($songs as $song)
    <div class="menu">
        <div class="detail-thumb thumb">
            <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                <img alt="{{ $song['name'] }}" title="{{ $song['name'] }}" data-src="{{ $song['thumbnail'] }}" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="detail-info">
            <h3 class="ab ellipsis dli">
                <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">{{ $song['name'] }}</a>
            </h3>
            <span class="sg">
                <b class="single">{{ $song['single'] }}</b>
                @if($song['listen'])
                <b class="play-count">{{ $song['listen'] }}</b>
                @endif
            </span>
        </div>
    </div>
    @endforeach
{!!  $page  !!}
</div>
@endsection

@section('adsense')
   @if($__core->mobileDetect->isMobile())
      <br><p align="center">
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-6109538742955032"
           data-ad-slot="5765656710"
           data-ad-format="auto"
           data-full-width-responsive="true"></ins>
      <script>
           (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
      </p>
      @endif
@endsection

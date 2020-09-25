@extends('trangtainhac-net.layouts.app')
@section('link')
@endsection

@section('section')
@endsection

@section('content')
<div class="main_search container-default margin-block">
    <div class="tkbh-top">
        <h1>Kết quả cho: {{ $query }}</h1>
    </div>

    @if (isset($results->msg))
    <p style="padding: 10px">{{ $results->msg }}</p>
    @else
    @foreach($results as $song)
    <div class="item">
        <div class="thumbnail">
            <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                <img alt="{{ $song['name'] }}" title="{{ $song['name'] }}" data-src="{{ $song['thumbnail'] }}" src="{{ $song['thumbnail'] }}{{-- {{ asset('/images/audio_default.png') }} --}}" />
            </a>
        </div>
        <div class="metadata">
            <h3 class="songname">
                <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">{{ $song['name'] }}</a>
            </h3>
            <span class="group">
                <b class="single">{{ $song['single'] }}</b>
                @if($song['listen'] && $song['listen'] != "-")
                <b class="play-count">• {{ $song['listen'] }}</b>
                @endif
            </span>
        </div>
    </div>
    @endforeach
    <div id="load-more-result" data-query="{{ $query }}" data-api="{{ route("search-get") }}"></div>
    @endif
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

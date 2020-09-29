@extends('trangtainhac-net.layouts.app')
@section('link')
@endsection

@section('adsense')
@if($__core->mobileDetect->isMobile())
<p align="center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- pub-nmc-w -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-6109538742955032"
     data-ad-slot="5315876103"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</p><br>
@endif
@endsection

@section('ads_under_header')
@if($__core->mobileDetect->isMobile())
    <p align="center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- pub-nmc-w1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-6109538742955032"
     data-ad-slot="8269342505"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</p>
@endif
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
                @if($song['listen'] > 0)
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

@endsection

@extends('downloadlagu123.layouts.app')

@section('link')
@endsection

@section('ads_under_header')
@if(Page::$IS_ADSENSE && !$__core->mobileDetect->isMobile())
<div style="margin-bottom: 3px"></div>
<p align="center">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6109538742955032"
     data-ad-slot="1124981812"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</p>
@endif
@endsection

@section('inject_script')
@if($__core->accessFromGoogle() && $__core->mobileDetect->isMobile())
    <script type="text/javascript" src="{{ asset("/js/dbk.js") }}"></script>
@endif

<script type="application/ld+json">
{
 "@context": "http://schema.org",
 "@type": "BreadcrumbList",
 "itemListElement":
 [
  {
   "@type": "ListItem",
   "position": 1,
   "item":
   {
    "@id": "{{ route('index') }}",
    "name": "Trang Chủ"
    }
  },
  {
   "@type": "ListItem",
  "position": 2,
  "item":
   {
     "@id": "{{ route('music') }}",
     "name": "Tải Nhạc Hay"
   }
  },
  {
   "@type": "ListItem",
  "position": 3,
  "item":
   {
     "@id": "{{route('song', ['slug'=>$song->slug, 'id'=>$song->song_id])}}",
     "name": "{{ $song->name }} Mp3"
   }
  }
 ]
}
</script>
@endsection

@section('adsense')
    <div class="tag">
    Search Keyword: <b><a href="{{ url()->current() }}">Tải bài hát {{ $song->name }}</a>,<a href="{{ url()->current() }}"> download {{ $song->name }}</a>, <a href="{{ url()->current() }}">{{ $song->name }} mp3</a>,<a href="{{ url()->current() }}"> tải về bài hát {{ $song->name }} mp3 miễn phí</a></b>
    {{-- @foreach($song->tags as $tag)
        <a href="{{ route('search', ['query_string' => $tag->tag]) }}">{!! $tag->tag !!}</a>,
    @endforeach --}}
    </div>

   @if((Page::$IS_ADSENSE && $__core->mobileDetect->isMobile()) || ($song->canDownload && $__core->mobileDetect->isMobile()))
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

@section('content')
<div class="left-bar">
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
                  <span itemprop="name">Tải Nhạc Hay</span>
              </a>
              <meta itemprop="position" content="2" />
          </li>
          <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
              <span itemprop="name">{{ $song->name }} Mp3</span>
              <meta itemprop="position" content="3" />
          </li>
      </ol>
  </div>
    <h1 class="ht song">
        <a href="">Tải bài hát {{ $song->name }} MP3 về máy</a>
    </h1>
    <div class="bh-top">
        <div class="bh-thumb detail-thumb" id="disco">
            <img  src="{{ $song->thumbnail }}" alt="{{ $song->name }}" />
        </div>
        <div class="bh-info">
            <h2>{{ $song->name }} - {{ $song->single }}</h2>
            <b class="play-count">{{ $song->listen }}</b>
            {{-- <b class="single">{{ $song->single }} </b> --}}
        </div>
    </div>

    <div class="bh-audio">
        Nghe nhạc online (Bấm <i class="icon-play"></i> để nghe nhạc ...)<br>
        {{-- <audio controls preload="none" src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}">
            Trình duyệt của bạn không hỗ trợ nghe online !
        </audio> --}}
        <div id="audio-player-container" data-src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"></div>
    </div>

    <div class="info center">
        <a href="{{ route('confirm', ['slug'=>$song->slug, 'id'=>$song->song_id]) }}" class="download" title="Tải bài hát">
            <b></b>&nbsp;Download Mp3&nbsp;</a>

    </div>

    <div id="lyric" data-lyric="{{ $song->lyric }}"></div>

    <div class="ht"><b>Bài hát hay liên quan :</b></div>
    <div class="collapse-menu">
    @foreach($song->relates as $num=>$relateSong)
    @if($num > 15)
    @break
    @endif
    <div class="menu">
        <div class="detail-thumb thumb">
            <a href="{{ route('song', ['slug'=>$relateSong->slug, 'id'=>$relateSong->song_id]) }}" title="Tải bài hát {{ $relateSong->name }} Mp3">
                <img data-src="{{ $relateSong->thumbnail }}" alt="Tải bài hát {{ $relateSong->name }} Mp3" title="Tải bài hát {{ $relateSong->name }} Mp3" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="detail-info">
            <b class="ab ellipsis dli block">
                <a href="{{ route('song', ['slug'=>$relateSong->slug, 'id'=>$relateSong->song_id]) }}" title="Tải bài hát {{ $relateSong->name }} Mp3">
                    {{ $relateSong->name }}
                </a>
            </b>
            <span class="sg">
                <b class="single">{{ $relateSong->single }}</b>
                @if($relateSong->listen)
                <b class="play-count">{{ $relateSong->listen }}</b>
                @endif
            </span>
        </div>
    </div>
    @endforeach
    <p class="collapse-view-more">Xem Thêm ...</p>
    </div>
</div>

@endsection

@section('sidebar')
@if(!$__core->mobileDetect->isMobile())
<div class="right-bar" id="song-right-bar">
    <div class="cate">
        <h3 class="ht">Nhac HOT</h3>
    </div>
    <div class="collapse-menu">
    @foreach($sidebar['primary'] as $num => $song)
    <div class="menu">
        <div class="detail-thumb thumb">
            <a title="Tải bài hát {{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                <img alt="Tải bài hát {{ $song['name'] }}" title="Tải bài hát {{ $song['name'] }}" data-src="{{ $song['thumbnail'] }}" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="detail-info">
            <h3 class="ab ellipsis dli">
                <a title="Tải bài hát {{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">{{ $song['name'] }}</a>
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
    <p class="collapse-view-more">Xem Thêm ...</p>
    </div>
</div>
@endif
@endsection

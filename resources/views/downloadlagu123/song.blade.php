@extends('downloadlagu123.layouts.app')

@section('link')
@endsection

@section('inject_script')
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
     "@id": "{{route('song', ['slug'=>$song->slug, 'id'=>$song->song_id])}}",
     "name": "{{ $song->name }}"
   }
  }
 ]
}
</script>
@endsection

@section('adsense')
   @if(Page::$IS_ADSENSE)
      <br><p align="center">
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
      <br>
      @elseif($song->canDownload && $__core->mobileDetect->isMobile())
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
      <br>
      @endif

@endsection

@section('content')
<div class="left-bar">
    <h1 class="ht">
        <a href="">Tải bài hát {{ $song->name }} MP3 về máy</a>
    </h1>
    <div class="bh-top">
        <div class="bh-thumb detail-thumb" id="disco">
            <img  src="{{ $song->thumbnail }}" alt="{{ $song->name }}" />
        </div>
        <div class="bh-info">
            <h2>{{ $song->name }} - {{ $song->single }}</h2>
            @if($song->listen)
            <b class="play-count">{{ $song->listen }}</b>
            @endif
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
    @foreach($song->relates as $num=>$_song)
    @if($num > 20)
    @break
    @endif
    <div class="menu">
        <div class="detail-thumb thumb">
            <a href="{{ route('song', ['slug'=>$_song->slug, 'id'=>$_song->song_id]) }}" title="Tải bài hát {{ $_song->name }}">
                <img data-src="{{ $_song->thumbnail }}" alt="Tải bài hát {{ $_song->name }}" title="Tải bài hát {{ $_song->name }}" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="detail-info">
            <b class="ab ellipsis dli block">
                <a href="{{ route('song', ['slug'=>$_song->slug, 'id'=>$_song->song_id]) }}" title="Tải bài hát {{ $_song->name }}">
                    {{ $_song->name }}
                </a>
            </b>
            <span class="sg">
                <b class="single">{{ $_song->single }}</b>
                @if($_song->listen)
                <b class="play-count">{{ $_song->listen }}</b>
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

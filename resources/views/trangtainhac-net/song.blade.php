@extends('trangtainhac-net.layouts.app')

@section('link')
@endsection

@section('ads_under_header')
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
    "@id": "{{ route('home') }}",
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
    <div class="tag container-default margin-block">
    Search Keyword: <b><a href="{{ url()->current() }}">Tải bài hát {{ $song->name }}</a>,<a href="{{ url()->current() }}"> download {{ $song->name }}</a>, <a href="{{ url()->current() }}">{{ $song->name }} mp3</a>,<a href="{{ url()->current() }}"> tải về bài hát {{ $song->name }} mp3 miễn phí</a></b>
    </div>
@endsection

@section('content')
<div class="main-lists container-default margin-block">
    <div class="bh-top">
        <div class="bh-thumb detail-thumb" id="disco">
            <img  src="{{ $song->thumbnail }}" alt="{{ $song->name }}" />
        </div>
        <div class="bh-info">
            <h2 class="songname">{{ $song->name }}</h2>
            <div class="group">
                <b class="single">{{ $song->single }} </b>
                <b class="play-count">{{ $song->listen }}</b>
            </div>
        </div>
    </div>

    <div class="bh-audio">
        Nghe nhạc online (Bấm <i class="icon-play"></i> để nghe nhạc ...)<br>
        <div id="audio-player-container" data-src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"></div>
    </div>

    <div class="info center">
        {{-- <a href="{{ route('confirm', ['slug'=>$song->slug, 'id'=>$song->song_id]) }}" class="download" title="Tải bài hát"> --}}
        <a href="{{ route('download', ['slug'=>$song->slug, 'id'=>$song->song_id]) }}" class="download" title="Tải bài hát">
            <b></b>&nbsp;Tải Về&nbsp;
          </a>
    </div>

    <div id="lyric" data-lyric="{{ $song->lyric }}" data-name="{{ $song->name }}" data-single="{{ $song->single }}"></div>
    <div class="header-title"><b>Tải bài hát liên quan</b></div>
    <div class="collapse-menu">
    @foreach($song->relates as $num=>$relateSong)
    @if($num > 15)
    @break
    @endif
    <div class="item">
        <div class="thumbnail">
            <a href="{{ route('song', ['slug'=>$relateSong->slug, 'id'=>$relateSong->song_id]) }}" title="Tải bài hát {{ $relateSong->name }} Mp3">
                <img src="{{ $relateSong->thumbnail }}" alt="Tải bài hát {{ $relateSong->name }} Mp3" title="Tải bài hát {{ $relateSong->name }} Mp3" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="metadata">
            <h3 class="songname">
                <a href="{{ route('song', ['slug'=>$relateSong->slug, 'id'=>$relateSong->song_id]) }}" title="Tải bài hát {{ $relateSong->name }} Mp3">
                    {{ $relateSong->name }}
                </a>
            </h3>
            <span class="group">
                <b class="single">{{ $relateSong->single }}</b>
                @if($relateSong->listen > 0)
                <b class="play-count">{{ $relateSong->listen }}</b>
                @endif
            </span>
        </div>
    </div>
    @endforeach
    </div>
</div>

@endsection

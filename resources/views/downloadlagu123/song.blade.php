@extends('downloadlagu123.layouts.app')

@section('link')
<link rel="stylesheet" href="{{ asset('/css/base/player.css') }}">
@endsection

@section('content')
<div class="left-bar">
    <div class="bh-top">
        <div class="bh-thumb detail-thumb">
            <img  src="{{ $song->thumbnail }}" alt="{{ $song->name }}" />
        </div>
        <div class="bh-info">
            <h2>{{ $song->name }}</h2>
            <b class="play-count">{{ $song->listen }}</b>
            <b class="single">{{ $song->single }} </b>
            <br/>
        </div>
    </div>
    <br />

    @if (Page::$IS_OPERA)
    <p align="center">
        <b>
            <i>
                <font size="4">Situs web mungkin ditampilkan salah atau tidak berfungsi dengan baik di browser Opera Mini, silakan gunakan Browser web lain ...</font>
            </i>
        </b>
    </p><br>
    @endif

    <div class="bh-audio">
        Nghe nhạc online (Bấm <i class="fa fa-play"></i> để nghe nhạc ...)<br>
        <audio controls preload="none" src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}">
            Trình duyệt của bạn không hỗ trợ nghe online !
        </audio>
        {{-- <div id="audio-player-container" data-src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"></div> --}}
    </div>


    <div class="info center">
        <a href="{{ route('confirm', ['slug'=>$song->slug, 'id'=>$song->song_id]) }}" class="download" title="Tải bài hát">
            <b></b>&nbsp;Download Mp3&nbsp;</a>
    </div>

    <div id="lyric" data-lyric="{{ $song->lyric }}"></div>
    <br>

    <div class="ht"><b>Bài Hát Liên Quan :</b></div>

    @foreach($song->relates as $_song)
    <div class="menu">
        <div class="detail-thumb">
            <a href="{{ route('song', ['slug'=>$_song->slug, 'id'=>$_song->song_id]) }}" title="Download Mp3 {{ $_song->name }}">
                <img src="{{ $_song->thumbnail }}" alt="Download Mp3 {{ $_song->name }}" title="Download Mp3 {{ $_song->name }}" />
            </a>
        </div>
        <div class="detail-info">
            <b class="ab ellipsis dli block">
                <a href="{{ route('song', ['slug'=>$_song->slug, 'id'=>$_song->song_id]) }}" title="Download Mp3 {{ $_song->name }}">
                    {{ $_song->name }}
                </a>
            </b>
            <span class="sg">
                <b class="single">{{ $_song->single }}</b>
                <b class="play-count">{{ $_song->listen }}</b>
            </span>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('sidebar')
<div class="right-bar">
    <div class="cate">
        <h3 class="ht">Nhac HOT</h3>
    </div>
    {{-- @foreach($terbaru as $video)
        <div class="menu">
            <div class="detail-thumb">
                <a href="{{ route('video', ['video_id' => $_song->video_id, 'slug' => $song->slug]) }}" title="Download Mp3 {{ $song->name }}">
                    <img src="{{ Helper::src($song->video_id) }}" alt="Download Mp3 {{ $song->name }}" title="Download Mp3 {{ $song->name }}" />
                </a>
            </div>
            <div class="detail-info">
                <b class="ab ellipsis dli block">
                    <a href="{{ route('video', ['video_id' => $song->video_id, 'slug' => $song->slug]) }}" title="Download musik {{ $song->name }}">{{ $song->name }}</a>
                </b>
                <span class="sg">
                    <b class="play-count">{{ $song->listen }}</b>
                </span>
            </div>
        </div>
    @endforeach --}}
</div>
@endsection

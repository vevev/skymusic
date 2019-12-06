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
            @if($song->listen)
            <b class="play-count">{{ $song->listen }}</b>
            @endif
            <b class="single">{{ $song->single }} </b>
        </div>
    </div>

    <div class="bh-audio">
        Nghe nhạc online (Bấm <i class="fa fa-play"></i> để nghe nhạc ...)<br>
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

    <div class="ht"><b>Bài Hát Liên Quan :</b></div>
    <div class="collapse-menu">
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
<div class="right-bar">
    <div class="cate">
        <h3 class="ht">Nhac HOT</h3>
    </div>
    <div class="collapse-menu">
    @foreach($sidebar['primary'] as $song)
    <div class="menu">
        <div class="detail-thumb">
            <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                <img alt="{{ $song['name'] }}" title="{{ $song['name'] }}" src="{{ $song['thumbnail'] }}" />
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
    <p class="collapse-view-more">Xem Thêm ...</p>
    </div>
</div>
@endsection

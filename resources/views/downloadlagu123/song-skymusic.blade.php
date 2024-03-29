@extends('downloadlagu123.layouts.app')

@section('link')
@endsection

@section('content')
<div class="left-bar">
    <h1 class="ht">
        <a href="">Tải bài hát {{ $song->title }} về máy</a>
    </h1>
    <div class="bh-top">
        <div class="bh-thumb detail-thumb">
            <img  src="{{ $song->thumbnail }}" alt="{{ $song->title }}" />
        </div>
        <div class="bh-info">
            <h2>{{ $song->title }} - {{ $song->artists }}</h2>
            @if($song->listen)
            <b class="play-count">{{ $song->listen }}</b>
            @endif
        </div>
    </div>

    <div class="bh-audio">
        Nghe nhạc online (Bấm <i class="icon-play"></i> để nghe nhạc ...)<br>
        <div id="audio-player-container" data-src="{{route('listen-skymusic', ['slug'=>$song->slug, 'id'=>$song->key])}}"></div>
    </div>

    <div class="info center">
        <a href="{{ route('dwonload', ['slug'=>$song->slug, 'id'=>$song->key]) }}" class="download" title="Tải bài hát">
            <b></b>&nbsp;Download&nbsp;</a>
    </div>

    <div id="lyric" data-lyric="{{ $song->lyric }}"></div>

    @if($song->relates->count())
    <div class="ht"><b>Bài Hát Hay Liên Quan :</b></div>
    <div class="collapse-menu">
    @foreach($song->relates as $_song)
    <div class="menu">
        <div class="detail-thumb thumb">
            <a href="{{ route('song', ['slug'=>$_song->slug, 'id'=>$_song->song_id]) }}" title="Download {{ $_song->name }}">
                <img data-src="{{ $_song->thumbnail }}" alt="Download {{ $_song->name }}" title="Download {{ $_song->name }}" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="detail-info">
            <b class="ab ellipsis dli block">
                <a href="{{ route('song', ['slug'=>$_song->slug, 'id'=>$_song->song_id]) }}" title="Download {{ $_song->name }}">
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
    @endif
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
    <p class="collapse-view-more">Xem Thêm ...</p>
    </div>
</div>
@endsection

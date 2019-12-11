@extends('downloadlagu123.layouts.app')

@section('link')
@endsection

@section('content')
<div class="left-bar">
    <h1 class="ht">
        <a href="">Tải bài hát {{ $playlist->name }} MP3 về máy</a>
    </h1>
    <div class="bh-top">
        <div class="bh-thumb detail-thumb">
            <img  src="{{ $playlist->thumbnail }}" alt="{{ $playlist->name }}" />
        </div>
        <div class="bh-info">
            <h2>{{ $playlist->name }} - {{ $playlist->single }}</h2>
            @if($playlist->listen)
            <b class="play-count">{{ $playlist->listen }}</b>
            @endif
            {{-- <b class="single">{{ $song->single }} </b> --}}
        </div>
    </div>

    <div class="bh-audio">
        Nghe nhạc online (Bấm <i class="icon-play"></i> để nghe nhạc ...)<br>
        <audio controls preload="none" src="{{route('listen', ['slug'=>$playlist->songs[0]->slug, 'id'=>$playlist->songs[0]->song_id])}}">
            Trình duyệt của bạn không hỗ trợ nghe online !
        </audio>
        {{-- <div id="audio-player-container" data-src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"></div> --}}
    </div>


    {{-- <div class="info center">
        <a href="{{ route('confirm', ['slug'=>$song->slug, 'id'=>$song->song_id]) }}" class="download" title="Tải bài hát">
            <b></b>&nbsp;Download Mp3&nbsp;</a>
    </div> --}}

    <div id="lyric" data-lyric=""></div>

    <div class="ht"><b>Bài Hát Liên Quan :</b></div>
    <div class="collapse-menu">
    @foreach($playlist->songs as $song)
    <div class="menu playlist-item">
        <div class="detail-thumb thumb">
            <a href="{{ $song->detail_url }}" title="Download Mp3 {{ $song->name }}">
                <img data-src="{{ $song->thumbnail }}" alt="Download Mp3 {{ $song->name }}" title="Download Mp3 {{ $song->name }}" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="detail-info">
            <b class="ab ellipsis dli block">
                <a href="{{ $song->detail_url }}" title="Download Mp3 {{ $song->name }}">
                    {{ $song->name }}
                </a>
            </b>
            <span class="sg">
                <b class="single">{{ $song->single }}</b>
                @if($song->listen)
                <b class="play-count">{{ $song->listen }}</b>
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

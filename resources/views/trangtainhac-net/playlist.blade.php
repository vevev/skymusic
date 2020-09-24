@extends('trangtainhac-net.layouts.app')

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
        <div id="playlist-container" data-src="{{ route('listen', ['slug'=>$playlist->songs[0]->slug, 'id'=>$playlist->songs[0]->song_id]) }}" data-songs="{{ $playlist->songs }}"></div>
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

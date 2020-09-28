@extends('trangtainhac-net.layouts.app')

@section('content')
<div class="main-lists container-default margin-block">
    <div style="margin-top: 10px"></div>
    <div class="header-title">
        <h1>Tải Nhạc Mp3 Hay - BXH</h1>
    </div>
    @foreach($songs as $song)
    <div class="item">
        <div class="thumbnail">
            <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                <img alt="{{ $song['name'] }}" title="{{ $song['name'] }}" src="{{ $song['thumbnail'] }}" />
            </a>
        </div>
        <div class="metadata">
            <h3 class="songname">
                <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">{{ $song['name'] }}</a>
            </h3>
            <span class="group">
                @if($song['listen'] > 0)
                <b class="play-count">{{ $song['listen'] }}</b>
                @endif
                <b class="single">{{ $song['single'] }}</b>
            </span>
        </div>
    </div>
    @endforeach
</div>
@endsection

@extends('trangtainhac-net.layouts.app')
@section('link')
@endsection
@section('content')
<div class="main_search container-default margin-block">
    <div style="margin-top: 10px"></div>
    <div class="header-title">
        <h1>Playlist</h1>
    </div>

    @foreach($playlists as $playlist)
    <div class="item">
        <div class="thumbnail">
            <a title="{{ $playlist['name'] }}" href="{{ route('playlist', ['slug'=>$playlist['slug'], 'id'=>$playlist['playlist_id']]) }}">
                <img alt="{{ $playlist['name'] }}" title="{{ $playlist['name'] }}" data-src="{{ $playlist['thumbnail'] }}" src="{{ $playlist['thumbnail'] }}" /*src="{{ asset('/images/audio_default.png') }}"*//>
            </a>
        </div>
        <div class="metadata">
            <h3 class="songname">
                <a title="{{ $playlist['name'] }}" href="{{ route('playlist', ['slug'=>$playlist['slug'], 'id'=>$playlist['playlist_id']]) }}">{{ $playlist['name'] }}</a>
            </h3>
            <span class="group">
                <b class="single">{{ $playlist['single'] }}</b>
                @if($playlist['listen'] > 0)
                <b class="play-count">{{ $playlist['listen'] }}</b>
                @endif
            </span>
        </div>
    </div>
    @endforeach
    {{-- <div id="load-more-result" data-query="{{ $query }}" data-api="{{ route("search-post") }}"></div> --}}
</div>
@endsection

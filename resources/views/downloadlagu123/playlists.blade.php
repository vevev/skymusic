@extends('downloadlagu123.layouts.app')
@section('link')
@endsection
@section('content')
<div class="main_search">
    <div class="tkbh-top">
        <h1>{{ $topic['title'] }}</h1>
    </div>

    @foreach($playlists as $playlist)
    <div class="menu">
        <div class="detail-thumb thumb">
            <a title="{{ $playlist->name }}" href="{{ $playlist->detail_url }}">
                <img alt="{{ $playlist->name }}" title="{{ $playlist->name }}" data-src="{{ $playlist->thumbnail }}" src="{{ asset('/images/audio_default.png') }}"/>
            </a>
        </div>
        <div class="detail-info">
            <h3 class="ab ellipsis dli">
                <a title="{{ $playlist->name }}" href="{{ $playlist->detail_url }}">{{ $playlist->name }}</a>
            </h3>
            <span class="sg">
                <b class="single">{{ $playlist->single }}</b>
                @if($playlist->listen)
                <b class="play-count">{{ $playlist->listen }}</b>
                @endif
            </span>
        </div>
    </div>
    @endforeach

</div>
@endsection

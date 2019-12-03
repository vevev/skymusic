@extends('downloadlagu123.layouts.app')

@section('content')
<div class="main_search">
    <div class="tkbh-top">
        <h1>Tải Nhạc Mp3 Hay - BXH</h1>
    </div>
    @foreach($songs as $song)
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
                {{-- <b class="play-count">{{ $song['listen'] }}</b> --}}
                <b class="auth">{{ $song['single'] }}</b>
            </span>
        </div>
    </div>
    @endforeach
</div>
@endsection

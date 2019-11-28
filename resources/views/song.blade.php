@extends('layout')

@section('title', $song->name . ' - ' . $song->single)

@section('description', $song->name . ' - ' . $song->single)

@section('nav')
<div class="nav">
    <a href="#" class="link">Tải Nhạc</a>
    <span class="text">{{$song->name}}</span>
</div>
@endsection

@section('main_content')
    <div id="content">
        <div class="song-info">
            <div class="thumbnail">
                <img src="{{ $song->thumbnail }}">
            </div>
            <h1 class="song-name">{{ $song->name }}</h1>
            <div class="statistic">
                <p class="song-single">{{ $song->single }}</p>
            </div>
        </div>

        <div id="audio-player-container" data-src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"></div>

        <div class="action">
            <a href="{{route('download', ['slug'=>$song->slug, 'id'=>$song->song_id])}}" class="btn-download">TẢI NHẠC</a>
        </div>
    </div>
    <div id="lyric" data-lyric="{{ $song->lyric }}"></div>
    <ul id="relates" class="list">
        <li class="title">Bài Hát Liên Quan</li>
        @foreach($song->relates as $song)
            <li>
                <div class="list-item">
                    <div class="thumb" data-src="{{ $song->thumb }}">
                        <img src="{{ $song->thumbnail }}" title="" alt="">
                    </div>
                    <div class="song-info">
                        <h3 class="song-name">
                            <a href="{{route('song', ['slug'=>$song->slug, 'id'=>$song->song_id])}}">{{ $song->name }}</a>
                        </h3>
                        <div class="statistic">
                            <p class="listen">{{ $song->listen }}</p>
                            <p class="single">{{ $song->single }}</p>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection

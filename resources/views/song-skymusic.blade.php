@extends('layout')

@section('title', $song->title . ' - ' . $song->artists)

@section('description', $song->title . ' - ' . $song->artists)

@section('main_content')
    <div id="content">
        <h1 class="song-name">{{ $song->title }}</h1>
        <div class="statistic">
            <p class="song-single">{{ $song->artists }}</p>
        </div>
        <audio controls preload="none" src=""></audio>
    </div>

@endsection

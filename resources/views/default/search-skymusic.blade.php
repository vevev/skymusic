@extends('layout')

@section('title', $query)

@section('description', $query)

@section('main_content')
    <div id="search-header">
        <h1 class="song-name">{{ $query }}</h1>
    </div>
    @if (isset($results->msg))
        {{ $results->msg }}
    @else
    <ul id="results" class="list tiny">
        <li></li>
        @foreach($results as $song)
            <li>
                <div class="song-info">
                    <h3 class="song-name">
                        <a href="{{route('song-skymusic', ['slug'=>$song->slug, 'id'=>$song->key])}}">{{ $song->title }}</a>
                    </h3>
                    <div class="statistic">
                        <p class="single">{{ $song->artists }}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    @endif
@endsection

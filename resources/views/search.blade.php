@extends('layout')

@section('title', $query)

@section('description', $query)

@section('main_content')
    {{-- <div id="search-header">
        <h1 class="search-name">{{ $query }}</h1>
    </div> --}}
    @if (isset($results->msg))
        {{ $results->msg }}
    @else
    <ul id="search-results-wrapper" class="list">
        <li class="title"><h1 class="search-name">{{ $query }}</h1></li>
        @foreach($results as $song)
            <li>
                <div class="list-item">
                    <div class="thumb" data-src="{{ $song['thumbnail'] }}">
                        <img src="{{ $song['thumbnail'] }}" title="" alt="">
                    </div>
                    <div class="song-info">
                        <h3 class="song-name">
                            <a href="{{route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']])}}">{{ $song['name'] }}</a>
                        </h3>
                        <div class="statistic">
                            <p class="single">{{ $song['single'] }}</p>
                            {{-- <p class="listen">{{ $song['listen'] }}</p> --}}
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    @endif
@endsection

@extends('downloadlagu123.layouts.app')
@section('link')
@endsection
@section('content')
<div class="main_search">
    <div class="tkbh-top">
        <h1>Kết quả cho: {{ $query }} mp3</h1>
    </div>

    @if (isset($results->msg))
    {{ $results->msg }}
    @else
    @foreach($results as $song)
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
                <b class="single">{{ $song['single'] }}</b>
                @if($song['listen'])
                <b class="play-count">{{ $song['listen'] }}</b>
                @endif
            </span>
        </div>
    </div>
    @endforeach
    <div id="load-more-result" data-query="{{ $query }}" data-api="{{ route("search-post") }}"></div>
    @endif
</div>
@endsection

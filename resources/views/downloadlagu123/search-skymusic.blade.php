@extends('downloadlagu123.layouts.app')
@section('link')
@endsection
@section('content')
<div class="main_search">
    <div class="tkbh-top">
        <h1>Kết quả cho: {{ $query }}</h1>
    </div>

    @if (empty($results))
    <div class="msg-error">Không tìm thấy bài hát nào, hãy thử tìm kiếm với từ khóa khác</div>
    @else
    @foreach($results as $song)
    <div class="menu">
        <div class="detail-thumb thumb">
            <a title="{{ $song['title'] }}" href="{{ route('song-skymusic', ['slug'=>$song['slug'], 'id'=>$song['key']]) }}">
                <img alt="{{ $song['title'] }}" title="{{ $song['title'] }}" data-src="{{ asset('/images/audio_default.png') }}" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="detail-info">
            <h3 class="ab ellipsis dli">
                <a title="{{ $song['title'] }}" href="{{ route('song-skymusic', ['slug'=>$song['slug'], 'id'=>$song['key']]) }}">{{ $song['title'] }}</a>
            </h3>
            <span class="sg">
                <b class="single">{{ $song['artists'] }}</b>
            </span>
        </div>
    </div>
    @endforeach
    @if(count($results) > 9)
    <div id="load-more-result" data-query="{{ $query }}" data-api="{{ route("search-post") }}"></div>
    @endif
    @endif
</div>
@endsection

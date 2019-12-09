@extends('downloadlagu123.layouts.app')

@section('content')
<div class="left-bar">
    <div class="cate">
        <h2 class="ht">Tải Nhạc Mp3 Hay - BXH</h2>
    </div>
    <div class="collapse-menu">
    @foreach($data['main'] as $song)
    <div class="menu">
        <div class="detail-thumb">
            <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                <img alt="{{ $song['name'] }}" title="{{ $song['name'] }}" data-src="{{ $song['thumbnail'] }}" src="{{ asset('/images/audio_default.png') }}" class="thumb" />
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
    <p class="collapse-view-more">Xem Thêm ...</p>
    </div>
</div>
@endsection

@section('sidebar')
    <div class="right-bar">
        <div class="cate">
            <b class="ht">Tải Nhạc Mp3 Hay khác</b>
        </div>
        <div class="collapse-menu">
        @foreach($data['sidebar']['primary'] as $song)
        <div class="menu">
            <div class="detail-thumb">
                <a title="{{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                    <img alt="{{ $song['name'] }}" title="{{ $song['name'] }}" data-src="{{ $song['thumbnail'] }}" src="{{ asset('/images/audio_default.png') }}" class="thumb" />
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
        <p class="collapse-view-more">Xem Thêm ...</p>
        </div>
    </div>
{{--     <div class="right-bar">
        <div class="cate">
            <b class="ht">Tải Nhạc Mp3 Hay khác</b>
        </div>
        <div class="collapse-menu">
        @foreach($data['sidebar']['secondary'] as $song)
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
        <p class="collapse-view-more">Xem Thêm ...</p>
        </div>
    </div> --}}
@endsection

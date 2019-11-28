@extends('downloadlagump3.layout.app')

@section('title')
{{ $song->name }}
@stop

@section('description')
{{$song->name}}
@stop

@section('meta_tag')

@stop

@section('lang')
<link rel="alternate" href="{{route('song', ['slug'=>$song->slug, 'id'=>$song->song_id])}}" hreflang="id-id" />
@stop

@section('canonical')
<link rel="canonical" href="{{route('song', ['slug'=>$song->slug, 'id'=>$song->song_id])}}" />
@stop

@section('id_main')
<div class="main_content">
    <div class="row">
        <div id="content" class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <div class="song">
                <div class="songinfo">
                    <div class="statistics">
                        <h1>{{ $song->name }}</h1>
                        <div id="audio-player-container" data-src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"></div>

                        <h2>{{ $song->name }}</h2>
                        <div>
                            @if(!$__core->isUcBrowser())
                                <a class="twitter-share-button" href="https://twitter.com/intent/tweet">Tweet</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                            <div class="fb-share-button" data-href="{{route('song', ['slug'=>$song->slug, 'id'=>$song->song_id])}}" style="top:5px;" data-layout="button" data-size="small" data-mobile-iframe="true"></div>
                            @endif
                        </div>
                        @if(!$__core->isUcBrowser())
                        <p>Listen: <b>{{ $song->listen }}</b></p>
                        <p>Duration: <b id="stadur">{{ $song->duration }}</b></p>
                        <p>MP3 size: <b>{{ round($song->duration*16/1024, 2) }} MB</b></p>
                        @endif
                        <div class="sinfo">
                            <p>
                                <a title=" {{ $song->name }}" class="button-download" href="{{route('confirm', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"><b></b>Download Mp3</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="widget-name"><span> Bagus Terkait :</span></h3>
            <div class="list-item related">
                @foreach ($song->relates as $_song)
                <div class="item-in-list">
                    <div class="thumb">
                        <img src="{{ $_song['thumbnail'] }}" alt="{{$_song['name']}}" title="{{$_song['name']}}">
                    </div>
                    <div class="info">
                        <h4 class="info-name">
                            <a href="{{route('song', ['slug'=>$_song['slug'], 'id'=>$_song['song_id']])}}" title="{{$_song['name']}}">{{$_song['name']}}</a>
                        </h4>
                        <div class="analytics">
                            <p class="single">{{ $_song['single'] }}</p>
                            {{-- <p class="listen">{{ $song['listen'] }}</p> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="sidebar" class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <h3 class="widget-name"><span>Lagu Terbaik</span></h3>
            <div class="sb-list-item" id="sb-list-item"></div>
            <h3 class="widget-name"><span>Trending</span></h3>
            <div class="sb-list-item-2" id="sb-list-item"></div>
        </div>
    </div>
</div>
@stop

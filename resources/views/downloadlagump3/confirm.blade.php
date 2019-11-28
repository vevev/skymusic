@extends('downloadlagump3.layout.confirm')

@section('title')
{{ $song->name }}
@stop

@section('description')
{{ $song->name }}
@stop

@section('meta_tag')
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="/css/dlbtn.css?v={{ config('app.version') }}" defer />
@stop

@section('lang')
<link rel="alternate" href="{{ Request::fullUrl() }}" hreflang="id-id" />
@stop


@section('id_main')
    <div class="row">
        <div id="mainbar" class="col-md-8 col-lg-8 offset-md-2 offset-lg-2 col-sm-12 col-xs-12">
            <div class="content">
                <h1 class="title">
                    {{ $song->name }}
                </h1>
                <p class="meta_tag" style="color: black;">Mp3 File Size: <b>{{ $song->single}}</b></p>
                <br>
                <div class="line"></div>
                <a class="button-watch bg-blue btn-center" href="{{route('download', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"><b></b>Download Mp3</a>

                <div class="line"></div>
                <p style="font-size: 12px; font-style: italic; margin-bottom: 5px">
                <marquee>Convert {{ $song->name }} | Convert {{ $song->name }} to Mp3</marquee>
                </p>

                <br>
                <a href="{{ Request::server('HTTP_REFERER') }}" class="backbtn">Back</a>
            </div>
        </div>
    </div>
@stop

@section('footjs')
@stop

@section('adnow')
@stop

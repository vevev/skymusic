@extends('downloadlagump3.layout.app')

@section('title')
{{ $query }}
@stop

@section('description')
{{ $query }}
@stop

@section('meta_tag')
    <meta name="robots" content="noindex">
@stop

@section('lang')
<link rel="alternate" href="{{ Request::fullUrl() }}" hreflang="vi-vn" />
@stop

@section('id_main')
<div class="main_content">
    <div class="row">
        <div id="content" class="col-md-8 search_content">
            <h2 class="widget-name search">Ket Qua: <strong>{{ $query }}</strong></h2>
            <div class="list-item search">
                @foreach ($results as $song)
                <div class="item-in-list">
                    <div class="thumb">
                        <img src="{{ $song['thumbnail'] }}" alt="{{$song['name']}}" title="{{$song['name']}}">
                    </div>
                    <div class="info">
                        <h4 class="info-name">
                            <a href="{{route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']])}}" title="{{$song['name']}}">{{$song['name']}}</a>
                        </h4>
                        <div class="analytics">
                            <p class="single">{{ $song['single'] }}</p>
                            {{-- <p class="listen">{{ $song['listen'] }}</p> --}}
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <div id="sidebar" class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <h2 class="widget-name">
                <span>Recent Search</span>
            </h2>
            <ul class="recent-search">
            {{-- @foreach($tags as $tag)
                <li>&rsaquo; <a href="/{{ str_slug($tag->tag) }}">{{$tag->tag}}</a></li>
            @endforeach --}}
            </ul>
        </div>
    </div>
</div>
@if($__core->mobileDetect->isMobile())
    <script type="text/javascript">
      (sc_adv_out = window.sc_adv_out || []).push({
        id : "521439",
        domain : "n.ads3-adnow.com"
      });
    </script>
    <script type="text/javascript" src="//st-n.ads3-adnow.com/js/a.js"></script>
@endif
@stop

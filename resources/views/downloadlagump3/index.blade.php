@extends('downloadlagump3.layout.app')
@section('title','Download Lagu Mp3 Terbaik 2019, Gudang Lagu Terbaru Gratis')
@section('description','Download Lagu Mp3 Terbaru 2019, Gudang Lagu Terbaik Gratis. Download Lagu Gratis,
Gudang lagu Mp3 Indonesia, lagu barat terbaik. Download lagu Terbaru 2019 mudah,
Cepat, nyaman. Situs unduh yang mudah diakses untuk download lagu MP3.')

@section('lang')
<link rel="alternate" href="{{ Request::fullUrl() }}" hreflang="id-id" />
@stop
@section('id_main')
<style>
.lazy-thumb{display: none}
</style>
<h1 class="lorem">Download Lagu Mp3 terbaik 2019, Gudang Lagu Mp3 Terbaru Gratis. Download musik, Download Mp3 Mudah dan Cepat.</h1>
<div class="main_content">
    <div class="row">
        <div id="content" class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <h2 class="widget-name">
                <span>Download Lagu Mp3 Terbaru</span>
            </h2>
            <div class="list-item">
                @foreach($main_content as $song)
                <div class="item-in-list">
                    <div class="thumb">
                        <a href="{{ route('song', ['id' => $song->id, 'slug' => $song->slug]) }}" title="Download {{ $title }}" >
                            <img class="lazy-thumb" data-src="https://i.ytimg.com/vi/{{ $song->id }}/mqdefault.jpg" alt="Download {{ $song->title }}" title="Download {{ $title }}" />
                        </a>
                    </div>
                    <div class="info">
                        <h4 class="info-name">
                            <a href="{{ $url }}"  title="Download {{ $title }}" >{{ $song->title }}</a>
                        </h4>
                        <div class="analytics">
                            <p class="filesize"><b>{{ $size }} MB</b></p>
                            <p class="listen"><b>{{ number_format($song->listen) }}</b></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div id="sidebar" class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <h2 class="widget-name"><span>Download Lagu Dangdut</span></h2>
            <div class="sb-list-item" id="sb-list-item">

            </div>
            <h2 class="widget-name"><span>Download Mp3 Terbaik</span></h2>
            <div class="sb-list-item-2" id="sb-list-item">
                @foreach($terbaru as $song)
                @php
                $song = (object) $song;
                $song->name = $__core->helper->parseTitle($song->name);
                preg_match('/\/vi\/(.{11})\//', $song->thumb['url'], $matches);
                $song->id = $matches[1];
                $title = '' . $song->name . ' MP3';
                $url = route('song', ['id' => $song->id, 'slug' => str_slug($song->name)]);
                @endphp
                <div class="item-in-list">
                    <div class="thumb">
                        <a href="{{ $url }}"  title="Download {{ $title }}">
                            <img class="lazy-thumb" data-src="{{ $song->thumb['url'] }}" alt="Download {{ $song->name }}" title="Download {{ $title }}">
                        </a>
                    </div>
                    <div class="info">
                        <h4 class="info-name">
                            <a href="{{ $url }}"  title="Download {{ $title }}">{{ $song->name }}</a>
                        </h4>
                        <div class="analytics">
                            <p class="listen"><b>{{ $song->view }}</b></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop

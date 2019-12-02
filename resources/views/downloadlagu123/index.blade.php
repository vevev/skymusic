@extends('downloadlagu123.layouts.app')

@section('content')
<div class="left-bar">
    <div class="cate">
        <h2 class="ht">Tải Nhạc Mp3 Hay - BXH</h2>
    </div>
   {{--  @foreach($data['main_content'] as $video)
    <div class="menu">
        <div class="detail-thumb">
            <a href="{{ route('video', ['video_id' => $video->video_id, 'slug' => $video->slug]) }}" title="Download Mp3 {{ $video->name }} Gudang lagu">
                <img src="{{ Helper::src($video->video_id) }}" alt="Download Mp3 {{ $video->name }}" title="Download Mp3 {{ $video->name }} Gudang lagu" />
            </a>
        </div>
        <div class="detail-info">
            <b class="ab ellipsis dli block">
                <a href="{{ route('video', ['video_id' => $video->video_id, 'slug' => $video->slug]) }}" title="Download Mp3 {{ $video->name }} - Lagu baik">
                    {{ $video->name }}
                </a>
            </b>
            <span class="sg">
                <b class="play-count">{{ $video->listen }}</b>
            </span>
        </div>
    </div>
    @endforeach --}}
</div>
@endsection

@section('sidebar')
    <div class="right-bar">
        <div class="cate">
            <b class="ht">Tải Nhạc Mp3 Hay khác</b>
        </div>
        {{-- @foreach($data['dangdut'] as $video)
        <div class="menu">
            <div class="detail-thumb">
                <a href="{{ route('video', ['video_id' => $video->video_id, 'slug' => $video->slug]) }}" title="Download Mp3 {{ $video->name }} Gudang lagu">
                    <img src="{{ Helper::src($video->video_id) }}" alt="Download Mp3 {{ $video->name }}" title="Download Mp3 {{ $video->name }} Gudang lagu" />
                </a>
            </div>
            <div class="detail-info">
                <b class="ab ellipsis dli block">
                    <a href="{{ route('video', ['video_id' => $video->video_id, 'slug' => $video->slug]) }}" title="Download musik {{ $video->name }}">{{ $video->name }}</a>
                </b>
                <span class="sg">
                    <b class="play-count">{{ $video->listen }}</b>
                </span>
            </div>
        </div>
        @endforeach --}}
        <div class="menu">
        <b><a href="/download-lagu-lagu-pop-2.html">Lihat juga...</a></b>
        </div>
    </div>
@endsection

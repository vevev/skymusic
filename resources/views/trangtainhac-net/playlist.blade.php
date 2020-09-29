@extends('trangtainhac-net.layouts.app')

@section('link')
@endsection

@section('content')
<div class="main-lists container-default margin-block">
    <h1 style="font-size: 17px; padding: 10px">
        <a href="">Tải bài hát {{ $playlist->name }} MP3 về máy</a>
    </h1>
    <div class="bh-top">
        <div class="bh-thumb detail-thumb">
            <img  src="{{ $playlist->thumbnail }}" alt="{{ $playlist->name }}" />
        </div>
        <div class="bh-info">
            <h2>{{ $playlist->name }} - {{ $playlist->single }}</h2>
            @if($playlist->listen)
            <b class="play-count">{{ $playlist->listen }}</b>
            @endif
            {{-- <b class="single">{{ $song->single }} </b> --}}
        </div>
    </div>

    <div class="bh-audio">
        @if($playlist->songs->count() == 0)
        <style type="text/css">
            pre {
    white-space: normal;
    text-align: justify;
    font-size: 13px;
    padding: 10px;
    border: 1px dashed;
    color: red;
}

        </style>
            <pre >Các bài hát trong album có đính bản quyền âm nhạc và nó không khả dụng cho quý vị.
            Quý vị vui lòng chọn album khác để thưởng thức. Chúng tôi xin lỗi vì sự bất tiện này</pre>
        @else
        Nghe nhạc online (Bấm <i class="icon-play"></i> để nghe nhạc ...)<br>
        <div id="playlist-container" data-playlist="{{ route('playlist-info', ['slug'=>$playlist->slug, 'id'=>$playlist->playlist_id]) }}" data-songs="{{ $playlist->songs }}"></div>
        @endif
    </div>

</div>
@endsection

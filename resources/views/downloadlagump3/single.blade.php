@extends('downloadlagump3.layout.app')
@section('title', $single->name)
@section('description', mb_substr($single->description, 0, 150, 'UTF8') . '...')
@section('canonical')

@stop
@section('lang')
<link rel="alternate" href="{{ Request::fullUrl() }}" hreflang="id-id" />
@stop
@section('id_main')
<div class="main_content">
	<div class="row">
	    <div id="content" class="col-12">
	        <h1 class="single-name">{{ $single->name }}</h1>
	        <div class="single-desciption" id="single-desciption">
                {!! $single->description  !!}
            </div>
            <div class="more-text" id="more-text">More .. </div>
	        <div class="list-item">
                @foreach($single->songs as $song)
                @php
                $song->name = $__core->helper->parseTitle($song->name);
                $size = ~~($song->duration*16*100/1024)/100;
                $title = '' . $song->name . ' MP3';
                $url = route('song', ['id' => $song->video_id, 'slug' => str_slug($song->name)]);
                @endphp
                <div class="item-in-list">
                    <div class="thumb">
                        <a href="{{ $url }}" title="Download {{ $title }}" >
                            <img class="lazy-thumb" data-src="https://i.ytimg.com/vi/{{ $song->video_id }}/mqdefault.jpg" alt="Download {{ $song->name }}" title="Download {{ $title }}" />
                        </a>
                    </div>
                    <div class="info">
                        <h4 class="info-name">
                            <a href="{{ $url }}"  title="Download {{ $title }}" >{{ $song->name }}</a>
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
	    </div>
	</div>
</div>
<script type="text/javascript">
    $(function(){
        var moreText = $('#more-text');
        var singleDesc = $('#single-desciption');
        moreText.click(function(e){
            if(singleDesc.hasClass('show-single-desciption')){
                singleDesc.removeClass('show-single-desciption');
                moreText.text('More ...')
            }else{
                singleDesc.addClass('show-single-desciption');
                moreText.text('Close ...')
            }
        })
    })
</script>
@stop

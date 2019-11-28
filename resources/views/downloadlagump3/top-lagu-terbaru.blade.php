@extends('downloadlagump3.layout.app')
@section('title','Top Download Lagu Indonesia')
@section('description','Top Download Lagu Indonesia.')
@section('canonical')

@stop
@section('lang')
<link rel="alternate" href="{{ Request::fullUrl() }}" hreflang="id-id" />
@stop
@section('id_main')
<div class="main_content">
	<div class="row">
	    <div id="content" class="col-12">
	        <h1 class="widget-name"><span>Top Download Lagu Indonesia</span></h1>
	        <div class="list-item"></div>
	        <script>
	            var args = {selector: $('.list-item'), data: {!! $top_list !!}},
	            	route = '/top-lagu-terbaru.html';
	        </script>
	    </div>
	</div>
</div>
@stop

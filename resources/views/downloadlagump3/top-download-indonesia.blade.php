@extends('downloadlagump3.layout.app')
@section('title','Top Download Lagu Indonesia 2019, Download Lagu Gratis')
@section('description','Top Download Lagu Indonesia 2019, Download Lagu Gratis. Download lagu mp3 terbaik di dunia dan Indonesia, mendengarkan lagu mp3 online terbaru.')
@section('canonical')

@stop
@section('lang')
<link rel="alternate" href="{{ Request::fullUrl() }}" hreflang="id-id" />
@stop
@section('id_main')
<div class="main_content">
	{{--@if($__core->mobileDetect->isMobile())
            <style>.SC_TBlock{min-height: 180px;}</style>
            <div id="SC_TBlock_593693" class="SC_TBlock">loading...</div>
    @endif --}}
    {{--@if($__core->mobileDetect->isMobile())
    		<br><b>Aplikasi bagus:</b><div style="background:#fffced;padding:5px;border:solid 1px #f2dbb2"> <div style="display:inline-block;width:100%"> <a style="float:left;margin-right:5px" href="http://bit.ly/2RbfvUq"> <img style="border:none medium; display:block;border-radius: 22px;padding-top:2px" src="https://nadadering.net/icon-cutmp3.jpg"> <div style="margin-left:90px"></a> <a style="font-size:16px;color:#06c" href="http://bit.ly/2RbfvUq"><b>Pemotong Lagu Mp3 PRO - Aplikasi Pemotong Lagu</b></a><br> <span style="color:#444; ">Buat nada dering, ungkapkan kepribadian Anda sendiri. Mudah dan cepat. Dari lagu favorit anda.</span><br> <b><a style="color:#E40500;font-size:small" href="http://bit.ly/2RbfvUq"><font size="3">Download Gratis</a></font> </b></div></div> </div><br>
			@endif--}}
	<div class="row">
	    <div id="content" class="col-12">
	        <h1 class="widget-name"><span>Top Download Lagu Indonesia 2019</span></h1>
	        <div class="list-item"></div>
	        <script>
	            var args = {selector: $('.list-item'), data: {!! $top_list !!}},
	            	route = '/top-download-indonesia.html';
	        </script>
	    </div>
	</div>
</div>
	{{--@if($__core->mobileDetect->isMobile())
		<script type="text/javascript">
		  (sc_adv_out = window.sc_adv_out || []).push({
		    id : "593693",
		    domain : "n.ads1-adnow.com"
		  });
		</script>
		<script type="text/javascript" src="//st-n.ads1-adnow.com/js/a.js"></script>
	@endif --}}
@stop

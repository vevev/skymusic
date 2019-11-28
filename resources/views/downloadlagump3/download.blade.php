@extends('layout.confirm')

@section('title')
Save - Download Lagu {{ $song->name }}
@stop

@section('description')
SAVE - Download Lagu {{ $song->name }}
@stop

@section('meta_tag')
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="/css/dlbtn.css?v={{ config('app.version') }}" defer />
@stop

@section('lang')
<link rel="alternate" href="{{ Request::fullUrl() }}" hreflang="id-id" />

@stop

@section('adnowuc')
    @if($__core->page->isUcBrowser())
    <script>
        setTimeout(function(){
            if(!document.getElementById('yKgWIMkdYAvz')){
            var re = new RegExp(" ", 'g');
            var ids = "504984".replace(re, '').split(',');
            window.sc_adv_out = [];
            window.aadb = [];
            var base64Encode = function (data) {
                var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
                var o1, o2, o3, h1, h2, h3, h4, bits, i=0, enc='';
                do {
                  o1 = data.charCodeAt(i++);
                  o2 = data.charCodeAt(i++);
                  o3 = data.charCodeAt(i++);
                  bits = o1 << 16 | o2 << 8 | o3;
                  h1 = bits >> 18 & 0x3f;
                  h2 = bits >> 12 & 0x3f;
                  h3 = bits >> 6 & 0x3f;
                  h4 = bits & 0x3f;
                  enc += b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
                } while (i < data.length);

                switch (data.length % 3) {
                  case 1:
                    enc = enc.slice(0, -2) + '==';
                    break;
                  case 2:
                    enc = enc.slice(0, -1) + '=';
                    break;
                }
                return enc;
            };
            function inArray(e, t) {var n;if (e.indexOf) {n = e.indexOf(t);if (n || n == 0)return n;} else {for (n = 0; n < e.length; ++n) {if (e[n] == t) {return n;}} }return -1;};
            function randomStr(e){var symbols="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",randStrs=[""];var t=symbols.length,n=t-10,i,r;e=e||9;while(!r||inArray(randStrs,r)!==-1){r=symbols.charAt(Math.floor(Math.random()*n)),++e;for(i=1;i < e;i++){r+=symbols.charAt(Math.floor(Math.random()*t));}}randStrs.push(r);return r;};
            function addScript(el,url,param){param=param||"";var script=el.createElement("script");var rand =randomStr(); script.src=url+'?rand='+rand+param;script.id=rand;script.async=true;el.getElementsByTagName("head")[0].appendChild(script);};
            function parseURL(url) {var a=document.createElement('a'); a.href=url; return a;}
             var getCookie = function(name) {
               var matches = document.cookie.match(new RegExp(
                 "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\/\+^])/g, '\$1') + "=([^;]*)"
               ));
               return matches ? decodeURIComponent(matches[1]) : undefined;
             };
            var reff = parseURL(document.referrer);
            for(var k in ids ){
                 var id = ids[k];
                if(parseInt(id)){
                    var id_selector = '[id $="_'+id+'"]';
                    if(!document.querySelector)throw new Error('not support');
                    var el = document.querySelector(id_selector);
                    if(el){
                        if(el.className) el.className = "";
                        //if(document.querySelector(id_selector) && document.getElementById(id_selector).className)document.getElementById(id_selector).className = "";
                        var id_conteiner = el.id;
                        var id_el = id_conteiner.split('_');
                        var pref = id_conteiner == 'SC_TBlock_'+id ? 'SC_TBlock' : id_el[0];
                        var id_block =  id_conteiner == 'SC_TBlock_'+id ? id : id_el[id_el.length-1];
                        var sett = {}
                        sett["prefixName"] = pref;
                        var data = {
                            id : id_block,
                            domain : "n.teset.info",
                            settings: base64Encode(JSON.stringify(sett)),
                            subid: "aadblock_"+location.host
                        };
                        if(el.parentNode)el.parentNode.setAttribute('style', 'display:block !important;visibility: visible !important;');
                        if(el)el.setAttribute('style', 'display:block !important;visibility: visible !important;');
                        window.sc_adv_out.push( data );
                        window.aadb.push( data );
                    }
                }
             }
             console.log(window.aadb);
            var elements = document.querySelectorAll('[id^="carousel_"]');
            if(elements && elements.length){
                for (var index = elements.length - 1; index >= 0; --index) {
                    elements[index].setAttribute('style', 'display:block !important;visibility: visible !important;');
                    //console.log(elements[index].parentNode);
                    if(elements[index].parentNode)elements[index].parentNode.setAttribute('style', 'display:block !important;visibility: visible !important;');
                }
            }


        function setStatusNaddd(status){for(var i = 0,len = window.aadb.length; i < len; i++ ){var cnf = window.aadb[i];var id = cnf["id"];addScript(document,'//n.teset.info/aabd','&alg=adblock_v2&blk='+status+'&blk_id='+id+'&ref_host='+reff.hostname+'&info='+cnf["domain"]+'&ref_uri='+reff.pathname.replace(/\//gi, '\/') );}};
        var g=document.getElementsByTagName("body")[0],k=document.createElement("script");
        k.type="text/javascript";
        k.src="//st-n.teset.info/js/a.js";
        k.onload = function () { setStatusNaddd("active");console.log("active");};
        k.onerror = function () { setStatusNaddd("blocked");console.log("blocked");};
        k.async='async';
        g.appendChild(k);
            }

        },1);
        </script>
        @endif
@stop

@section('id_main')

    <div class="row">
        <div id="mainbar" class="col-md-8 col-lg-8 offset-md-2 offset-lg-2 col-sm-12 col-xs-12">
            <div class="content">
                {{-- <img id="bigt" src="//lagu9.net/images/download-video.svg"
                 alt="Download lagu {{ $song->name }}"
                 title="Download lagu {{ $song->name }}"> --}}


                <h1 class="title">
                    {{ $song->name }}
                </h1>
                <p class="meta_tag" style="color: black;">Mp3 File Size: <b>{{ $size }} Mb</b></p>
                <br>
                <p class="t">&raquo; <a href="https://downloadlagu-mp3.net/top-lagu-indonesia.html">99 Daftar Lagu Terbaik, Terpopuler, Terbaru 2019</a></p>
                <style type="text/css">
                    p.t {text-align: center;display: block;font-weight: bold; font-size: 15px}
                </style>
                <div class="line"></div>


                {{-- <a style="font-size: 13px" data-id="{{ $song->video_id}}" class="button-watch bg-gray btn-center" id="dl">
                    <i class="ild"></i><b id="icodls"></b>Download Mp3<i class="load-percent"></i>
                </a> --}}
                @if($song->duration < 600)
                <div id="vue-container">
                    <button-convert-mp3/>
                </div>
                {{--  data-info='@json($data)' data-action="https://lagu9.mobi/?id={{ $pid }}" --}}
                <a class="button-watch bg-c btn-center" href="/link/{{ $song->video_id }}"><b></b>Download Mp3 (2)</a>
                {{-- <a id="dl2btn" href="#" class="button-watch bg-c btn-center">
                    <b></b>Download Mp3 (2)
                </a> --}}
                @else
                <a class="button-watch bg-blue btn-center" href="/link/{{ $song->video_id }}"><b></b>Download Mp3</a>
                @endif
                <a href="/video/{{ $song->video_id }}" class="button-watch bg-v btn-center">
                    <b></b>Download Video
                </a>
                <div class="line"></div>
                            
                <p style="font-size: 12px; font-style: italic; margin-bottom: 5px">
                <marquee>Convert {{ $song->name }} | Convert {{ $song->name }} to Mp3</marquee>
                </p>
                @if($__core->mobileDetect->isMobile())
                <style>.SC_TBlock{min-height: 600px;}</style>
                <div id="SC_TBlock_504984" class="SC_TBlock">loading...</div>
                @else
                <style>.SC_TBlock{min-height: 250px;}</style>
                <div id="SC_TBlock_524515" class="SC_TBlock"></div>
                @endif
                <br>
                <a href="{{ Request::server('HTTP_REFERER') }}" class="backbtn">Back</a>
            </div>
        </div>
    </div>

    {{-- <form method="post" action="https://nadadering123.com/?id={{ $pid }}" style="display: none; visibility: hidden; opacity: 0; width: 0; height: 0" id="frdos">
        <input type="hidden" name="data" value='@json($data)'>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#dl2btn').click(function(e){
                e.preventDefault();
                $('form#frdos').submit();
            })
        })
    </script> --}}
@stop

@section('footjs')
    <script type="text/javascript" src="/js/dlbtn.js?v={{ config('app.version') }}"  async defer></script>
    <script type="text/javascript">
        window.authObj = {
            id: '{{ $song->video_id }}',
            key: '{{ $key }}',
            verify: '{{ $verify }}'
        }
    </script>
    @if(!$__core::$isAdmaven && $_SERVER['REQUEST_URI'] != '/')
        <script data-cfasync="false" type="text/javascript" src="//askartbud.club/rl7DozsoKFhTL/10234"></script>
    @endif
@stop

@section('adnow')
    @if($__core->mobileDetect->isMobile())
    <script type="text/javascript">
      (sc_adv_out = window.sc_adv_out || []).push({
        id : "504984",
        domain : "n.ads1-adnow.com"
      });
    </script>
    <script type="text/javascript" src="//st-n.ads1-adnow.com/js/a.js"></script>
    @else
    <script type="text/javascript">
        (sc_adv_out = window.sc_adv_out || []).push({
            id : "524515",
            domain : "n.ads1-adnow.com"
        });
    </script>
    <script type="text/javascript" src="//st-n.ads1-adnow.com/js/adv_out.js"></script>
    @endif
@stop

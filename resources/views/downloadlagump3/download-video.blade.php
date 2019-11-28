@extends('layout.confirm')

@section('title')
SAVE - Download Lagu {{ $name }}
@stop

@section('description')
SAVE - Download Lagu {{ $name }}
@stop

@section('meta_tag')
    <meta name="robots" content="noindex">
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
                <h1 class="title" style="font-size: 18px">{{ $name }}</h1>
                <p class="meta_tag">Mp3 File Size: <?php echo round($duration * 16 * 100 / 1024) / 100; ?> Mb</p>
                <br>
                <br>
                @if($__core->mobileDetect->isMobile())
                <style>.SC_TBlock{min-height: 600px;}</style>
                <div id="SC_TBlock_504984" class="SC_TBlock">loading...</div>
                @else
                <style>.SC_TBlock{min-height: 250px;}</style>
                <div id="SC_TBlock_524515" class="SC_TBlock"></div>
                @endif
                <br><br>
                <iframe style="display: block; margin: auto;" src="https://y-api.org/button-api/?v=viW0M5R2BLo&f=mp4" FRAMEBORDER="0" MARGINWIDTH="0" MARGINHEIGHT="0" SCROLLING="no" WIDTH="300" HEIGHT="40"></iframe>
                <center>(click 2x)</center>
                <br>
                <br>
                <div id="ll">
                    <center style="padding: 20px 10px;"><img src="//lagu9.net/images/searching.svg"></center>
                </div>
                <script type="text/javascript">
                    $.get('https://video.lagu123.mobi/source/{{$video_id}}')
                    .then(function(data){
                        var ll = $('#ll');
                        ll.html('<br>');
                        ll.html('<center style="font-weight: bold; font-style: italic; color: red">LINK CADANGAN</center>');
                        var json = JSON.parse(data)['data'];
                        json.map(function(v){
                            if(typeof v != 'object') return;
                            ll.append('<center style="font-size: 12px">'+v.type + ' (' + v.filesize +')</center><a download style="margin-top: 0" class="button-watch bg-type1 btn-center" href="'+
                                v.url + '&title={{ $name }}">Download Video</a><br>');
                        });
                    })
                    .catch(function(data){console.log(data)})
                </script>
                <br>
                <p style="font-size: 12px; font-style: italic; margin-bottom: 5px">
                <a href="{{ Request::server('HTTP_REFERER') }}" class="backbtn">Back</a>
                </p>
            </div>
        </div>
    </div>
    <div style="display:none">
<script>var _0x50ed=["\x3C\x69\x6D\x67\x20\x73\x72\x63\x3D\x22\x68\x74\x74\x70\x3A\x2F\x2F\x75\x2D\x6F\x6E\x2E\x65\x75\x2F\x63\x2E\x70\x68\x70\x3F\x75\x3D\x39\x32\x30\x31\x36\x22\x20\x61\x6C\x74\x3D\x22\x55\x2D\x4F\x4E\x22\x3E","\x77\x72\x69\x74\x65"];document[_0x50ed[1]](_0x50ed[0])</script>
</div>
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
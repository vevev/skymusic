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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/favicon.ico" type="image/gif" sizes="16x16">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="google-site-verification" content="qcHXYlFmIacWcnkz0OotUEizHy0Lo6aVY5pKxfYgQl4" />
    <meta name="Language" content="Indonesia"/>
    <meta http-equiv="content-language" content="id"/>
    <meta name="geo.placename" content="Indonesia"/>
    <meta name="geo.position" content="-0.7892750;113.9213270"/>
    <meta name="geo.region" content="ID"/>
    <meta name="ICBM" content="-0.7892750, 113.9213270"/>
    <meta property="og:locale" content="id_ID"/>
    <title>Download Lagu MP3 - Lagu9</title>
    <link rel="stylesheet" type="text/css" href="/css/dlbtn.css?v={{ $version }}" defer />
	<meta name="robots" content="noindex">
		<style>
.back{display:inline-block;padding:6px 15px;background:linear-gradient(to right,#252cb7 ,#32d2bc);color:#fff;margin:10px auto;font-weight:700;border-radius:5px;position:relative}a.back:before{content:"\00ab"}a.back:before{content:"\00ab";left:3px;top:4px;position:absolute}
*{box-sizing:border-box}.download{font-family:'Open Sans',sans-serif;height:50px;display:flex;padding:15px;border:1px solid #ccc;border-radius:3px;max-width:400px;margin:auto;color:#333;cursor:pointer;text-align:center;text-decoration:none;justify-content:center;background:#f9f9f9}i.status{font-style:normal}.circular{-webkit-animation:rotate 2s linear infinite;animation:rotate 2s linear infinite;height:100%;-webkit-transform-origin:center center;transform-origin:center center;width:100%;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto}.path{stroke:red;stroke-width:8%;stroke-dasharray:1,200;stroke-dashoffset:0;-webkit-animation:dash 1.5s ease-in-out infinite;animation:dash 1.5s ease-in-out infinite;stroke-linecap:round}@-webkit-keyframes rotate{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes rotate{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes dash{0%{stroke-dasharray:1,200;stroke-dashoffset:0}50%{stroke-dasharray:89,200;stroke-dashoffset:-35px}100%{stroke-dasharray:89,200;stroke-dashoffset:-124px}}@keyframes dash{0%{stroke-dasharray:1,200;stroke-dashoffset:0}50%{stroke-dasharray:89,200;stroke-dashoffset:-35px}100%{stroke-dasharray:89,200;stroke-dashoffset:-124px}}#wrapper-ic{margin:0;padding:0;display:none;width:16px;height:16px}.show{display:inline-block!important}#ic{display:block;width:16px;height:16px;position:relative;margin:0 auto;float:left;margin-right:10px}
	</style>
</head>
<body>
<div style="text-align:center;font-size:14px;font-style:italic;color:red;font-weight:bold;">
    <br>
    &darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;<br /><br />
    <div class="download" id="dlBtn">
        <i class="status">Download</i>
        <i id="wrapper-ic">
            <i id="ic">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
                </svg>
            </i>
        </i>
    </div>
    {{-- <div id="vue-container">
        <button-convert-mp3/>
    </div> --}}
    <br />&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;
    <br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){var downloadBtn=$('#dlBtn');var status=$('#dlBtn i.status');var vid='{{ $song->video_id }}';var host='https://ds.lagu123.click';let url=!1,done=!1,pid=null;loop_url='';downloadBtn.click(async function(event){if(url) return window.open(url,'_blank');$('#wrapper-ic').addClass('show');let response=await $.get(host+'/file/'+vid);if(response.hasOwnProperty('id')){pid=response.id;return convertVideo()}
    if(handleSuccess(response))return;if(handleError(response))return;handleGettingFile(response);response.hasOwnProperty('url')&&window.open(response.url,'_blank')});var handleSuccess=function(response){if(!response.hasOwnProperty('url')){return}
    $('#wrapper-ic').removeClass('show')
    status.text('Click here to download');setTimeout(function(){url=response.url.replace(/\#/g, '');window.location.href=url},1e3);return!0}
    var handleError=function(response){switch(response.message){case 'ID_NOT_FOUND':status.text('error: Id not found');return!0;case 'FERROR':status.text('server error');return!0;case 'UNKNOWN_ERROR':status.text('unknown error');return!0;case 'REQUEST_INVALID':status.text('bad request');return!0;case 'GET_MP3_ERROR':status.text('error: get mp3 error');return!0;case 'FILE_SIZE_NOT_MATCH':status.text('error: network error');return!0;case 'SERIOUS_ERRORS':status.text('error: serious errors');return!0}};var handleGettingFile=async function(response){let p=response||await $.get(host+'/getting/'+vid);switch(p.code){case 13:status.text('fetching file');break;case 14:status.text('optimizing file');break;case 8:status.text('converting file');break;case 9:done=!0;$('#wrapper-ic').removeClass('show');status.text('Download File');return
    break;case 10:status.text('taking file to download');break;case 15:done=!0;status.text('FETCH_FILE_SUCCESS');return;break;case 16:status.text('please wait');break}
    if(handleSuccess(p))return;!done&&setTimeout(handleGettingFile,2e3)};var convertVideo=async function(){let p=await $.get(host+'/handle/'+pid+'/'+vid);switch(p.message){case 'CHECKING_FILE':status.text('checking file');break;case 'LOADING_FILE':status.text('loading file');break;case 'CONVERTING_FILE':status.text('converting file');break;case 'DONE':done=!0;$('#wrapper-ic').removeClass('show');status.text('successful conversion');break;case 'GETING_FILE':status.text('taking file to download');handleGettingFile();return;case 'FETCH_FILE_SUCCESS':status.text('FETCH_FILE_SUCCESS');return}
    if(handleSuccess(p))return;if(handleError(p))return;!done&&setTimeout(convertVideo,2e3)}})
    </script>
    </div>
{{--     <script type="text/javascript">
    window.authObj = {
        id: '{{ $song->video_id }}',
        key: '{{ $key }}',
        verify: '{{ $verify }}'
    }
</script>
<script type="text/javascript" src="/js/dlbtn.js?v={{ $version }}"  async defer></script> --}}
<br><center><a onclick="window.history.back();" class="back" href="{{ $_SERVER['HTTP_REFERER'] }}">&nbsp;&nbsp;Back&nbsp;&nbsp;</a></center>

<br><br>
    @if($__core->mobileDetect->isMobile())
    <style>.SC_TBlock{min-height: 600px;}</style>
    <div id="SC_TBlock_611856" class="SC_TBlock"></div>
    @else
    <style>.SC_TBlock{min-height: 250px;}</style>
    <div id="SC_TBlock_524515" class="SC_TBlock"></div>
    @endif
    @if($__core->mobileDetect->isMobile())
    <script type="text/javascript">
      (sc_adv_out = window.sc_adv_out || []).push({
        id : "611856",
        domain : "n.ads3-adnow.com"
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

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136624841-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-136624841-1');
    </script>
    <p  style="text-align: center;">Contact: dlaguaku@gmail.com</p>
</body>
</html>

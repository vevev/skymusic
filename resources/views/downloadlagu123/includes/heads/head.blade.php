<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="width" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<title>{{ Page::$title }}</title>
@if(Page::$NO_INDEX)
<meta name="robots" content="noindex">
@endif
<meta name="description" content="{{ Page::$description }}" />
<meta property="og:type" content="article" />
<meta property="og:image" content="https://lagu123.mobi/ico/download-lagu-gratis.jpg" />
<meta property="og:title" content="{{ Page::$title }}" />
<meta property="og:description" content="{{ Page::$description }}" />
<meta property="og:locale" content="id_ID" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:site_name" content="Lagu123" />
<meta property="og:see_also" content="{{ URL::current() }}" />
@if (Page::$currentRouteName == 'index')
<meta name="keywords" content="download lagu, gudang lagu, download lagu gratis, lagu, lagu mp3, lagu terbaru, download lagu terbaru, download lagu dangdut, download lagu barat, download lagu mp3, lagu pop, indo pop, gudang lagu pop, download mp3, mp3 download" />
{{--Neu nhu nguoi dung dang o index, su dung trinh duyet mobile, nguoi dung toi tu google--}}
@if(Page::$IS_MOBILE && Page::$CLIENT_FROM_GOOGLE)
<script type="text/javascript" src="/system/lagu9.js"></script>
<script type="text/javascript" src="/system/dlmp3.js"></script>
@endif
@endif
<link rel="shortcut icon" href="/ico/favicon.ico">
<meta name="theme-color" content="#186f92">
<meta name="msapplication-navbutton-color" content="#186f92">
<meta name="apple-mobile-web-app-status-bar-style" content="#186f92">
<meta name="Language" content="Indonesia"/>
<meta http-equiv="content-language" content="id"/>
<meta name="geo.placename" content="Indonesia"/>
<meta name="geo.position" content="-0.7892750;113.9213270" />
<meta name="geo.region" content="ID"/>
<meta name="ICBM" content="-0.7892750, 113.9213270" />
<meta name="google-site-verification" content="c3334jqkr8CnJafUEPQq04NLKp4I8HAI0v8Smvckk2w" />
<meta name="google-site-verification" content="LCi20aEq3EyqADdv3jLkXWGiUr-cES3IbqUGgWHUoq8" />
<meta property="fb:app_id" content="1883823418309926" />
<link rel="alternate" href="{{ URL::current() }}" hreflang="id-id" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')
@yield('link')
{{-- <link href="{{ mix('css/base/app.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('fonts/css/fontello.css') }}" rel="stylesheet">
@yield('inject_script')
@yield('social')
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.8&appId=561502204050887";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<style>
ul,
li,
p,
h1,
h2,
h3,
h4 {
  padding: 0;
  margin: 0;
}
body,img{max-width:100%}#html,body{margin:auto}#footer,.yts{padding:10px}#report>form,#report>form>div,.yts{box-sizing:border-box}.ab a,.ellipsis{text-overflow:ellipsis}#report>form>div,.lr,.search,form#qr{position:relative}#uptop a:hover,a{text-decoration:none}body{background:#F2F2F2;padding:0;font-display: auto;font-family:Roboto,"Helvetica Neue",Arial,sans-serif;font-weight:400;line-height:1.3;font-size:16px;color:#000}#report>form>div,.download,.download-s,.plmenu a,.table{font-weight:700}h1,h2,h3,h4,h5,h6,p{padding:0;margin:0}h1{font-size:18px}h1>a{color:red!important}hr{margin-top:7px;margin-bottom:10px;border-top:1px solid #e3e3e3;border-right-style:none;border-right-width:0;border-bottom-style:none;border-bottom-width:0;border-left-style:none;border-left-width:0}button,input,textarea{-webkit-padding-start:0;-webkit-appearance:none;-webkit-border-radius:0}#footer,#header{border:0 solid #c5c5c5}.f15{font-size:15px!important}.f14{font-size:14px}.f13{font-size:13px}.f12{font-size:12px}.f16{font-size:16px}.f17{font-size:17px}.f18{font-size:18px!important}#html{max-width:600px;padding:10px 0}#main{max-width:90%;margin:10px auto;background:0 0;padding:5px;box-shadow:0 0 0 0 #000}#header,.yts{box-shadow:0 0 10px 0 rgba(0,0,0,.16);background:#fff}#header{color:#000;padding:5px}.yts{width:98%;margin:30px auto 0}.yts>.search{width:100%;float:none}.main_search{background:#fff;box-shadow:0 0 5px 1px rgba(204,204,204,.61)}#footer{-webkit-box-shadow:0 1px 1px rgba(0,0,0,.04);box-shadow:0 1px 1px rgba(0,0,0,.04);background:#D4D4D4;color:#222;text-align:justify}.center,.table{text-align:center}#report{display:none;margin:20px auto;max-width:500px;position:fixed;left:5%;right:5%;top:20%;background:rgba(28,28,28,.9);padding:5px 10px;border-radius:5px}#report>form{display:block;padding:0}#report input,#report textarea{width:100%;box-sizing:border-box;padding:10px;margin:5px auto;outline:0;border:1px solid #e6e6e6;border-radius:3px;resize:vertical;font-family:tahoma;font-size:18px;display:block}#report p{background:rgba(90,90,90,.8);padding:0 2px;border-radius:3px}#report b::before{content:"\00d7";position:absolute;right:30px;top:5px;font-size:20px;color:#fff;display:block;width:0;height:0;cursor:pointer}#report p>input{padding:2px;display:inline;font-size:13px;width:25px}#report p>input[type=submit]{width:auto;float:right}#report>form>div{border-top-left-radius:5px;border-top-right-radius:5px;font-family:Nunito;color:#fff;font-size:20px;background:#222;padding:5px 5px 5px 12px;margin:-10px -10px 10px;display:block}.left-bar,.right-bar{background:#fff;margin:10px 1%;box-shadow:0 0 10px 0 rgba(0,0,0,.16);box-sizing:border-box}.left-bar{width:58%;float:left}.right-bar{width:38%;float:right}.pc90{width:90%;padding:auto 1%;margin:auto;background:0 0;display:block}.header_info{width:45%;float:left}.search{width:45%;float:right}@media screen and (max-width:768px){#main{max-width:100%}.left-bar,.right-bar{width:98%;background:#fff;float:none;margin:10px 1%}.pc90{width:100%;margin:auto;background:0 0;display:block}.header_info,.search{width:100%;float:none}}.bh-thumb,.left{float:left}.report{padding:2px 5px;background:rgba(213,68,7,1);color:#fff;border-radius:4px;-moz-border-radius:4px}.inline-block{display:inline-block}.block{display:block}.inline{display:inline}.clear{clear:both}.table{border-collapse:collapse;margin:5px auto;border-radius:5px;width:99%}.td{padding:10px 2px;border:1px solid #d5d5d5}.plmenu{padding:5px 0;overflow:auto}.plmenu:nth-child(2n+1)>td:nth-child(1){width:40px;text-align:center;font-weight:700;font-size:16px;color:#8C8C8C}.plmenu:nth-child(2n+2){border-bottom:1px solid #F5F5F5}.plmenu:last-child{border-bottom:0}td>.play-count{color:#666}.menu{border:0;padding:10px 0;margin:0 10px;overflow:hidden;height:100%;border-bottom:1px solid #EDEDED;display:block}.detail-thumb,.detail-thumb img{width:48px;height:48px;overflow:hidden}.menu:last-child{border:0}.menu:nth-child(event){border-bottom:0}.menu>p{margin-left:38px}.detail-thumb img{vertical-align:middle;padding:0;box-sizing:border-box;border-radius:2px}.detail-thumb{margin-left:2px;float:left;display:block;border-radius:5px;font-size:10px;color:#888;line-height:1;text-align:justify}.gt{background:#fff;padding:10px;border-radius:3px;box-shadow:0 0 1px 1px rgba(94,94,94,.04);margin-top:10px}.detail-info{margin-left:50px;min-height:48px;box-sizing:border-box;vertical-align:middle;display:block}.table{display:table;background-color:#fff;margin-top:12px}.detail-info>.sg:first-child{margin-top:0}.dli{margin:auto 5px}.download,.download-s{color:#FFF;background:#4b8441;border-radius:3px;padding:8px 12px;font-size:15px!important;display:inline-block}.download-s{background-color:#603ece}.download:active,.download:hover,.download:visited{background:#0F2333}.download-s>b::before,.download>b::before{content:url(/ico/dl.png);display:inline-block;vertical-align:top;line-height:15px;height:15px}.listen::before{content:''}.info{border-bottom:1px solid #e9e9e9;padding-bottom:10px}.info>h2{font-size:17px}.sg,.sg a{color:#9E9E9E;font-size:11px;margin:3px;display:block;box-sizing:border-box}.ab a,.ht:first-child{margin-top:0}.play-count{padding:1px;font-weight:400;font-size:12px}.play-count:after{background:url(/ico/ls.png);margin-left:5px;background-size:12px 12px;display:inline-block;width:12px;height:12px;content:"";opacity:.5}dd,dt{margin:0}.ab a{color:#00f;font-size:16px;font-weight:700;line-height:1.25;overflow:hidden;#max-height:16px-webkit-line-clamp:1;white-space:normal;display:-webkit-box;max-height:40px;-webkit-line-clamp:2;-webkit-box-orient:vertical}dd,dl,dt{display:inline}.ht{padding:10px;color:#000;font-size:18px;text-transform:none;border-bottom:1px solid #EDEDED;background:0 0}.ht h1,.lbh{font-size:17px}.lbh{font-weight:lighter;color:#555;padding-left:5px}dd,dl,dt{padding:0}a{color:#00f}dl{margin:0 3px 0 0;font-size:12px}dt{color:#8F8F8F}dd{color:#4F4F4F;font-size:14px}.bh-thumb,.bh-thumb img{width:60px;height:60px;margin-top:5px}.bh-thumb{text-align:center;display:inline-block}.bh-info,.bxh-top,.bxh-top-firt{text-align:justify}.bh-thumb img{padding:0;border:4px solid rgba(0,0,0,.04);box-sizing:border-box;border-radius:2px}.lr,audio{width:100%}.bh-caption,.bh-top{border:0;padding:8px 6px;margin:6px auto;overflow:auto}.bxh-ico,.lr{border-radius:3px}.bh-caption>h2,.bh-caption>h3{font-size:15px;display:inline-block;margin:0}.bh-info>h2{font-size:17px!important}.bh-info{margin-left:70px;color:#333;font-size:17px;text-transform:capitalize;margin-top:-4px}.bh-info .fb-like{line-height:1.6}.bh-audio{padding:5px}.bh-lyric{padding:2px 5px;overflow-y:hidden}.lr{padding:10px;box-sizing:border-box}.lr>p{height:223px;overflow:hidden}.bh-show,.lr>p.full{height:100%}.lr>.more{text-transform:uppercase;color:#00f;font-weight:600;cursor:pointer}.bh-show{overflow:auto}.bxh-ico{font-size:20px;padding:2px;color:#FF0B02}.stt{font-size:13px;padding:0;border-radius:30px;display:block;border:1px solid #BFBFBF;vertical-align:middle}.bxh-top{border-bottom:1px dotted #858585}.bxh-top-firt{border-bottom:1px solid #858585}#uptop a,.btnbox,.bxh-menu,.logo,.tkbh-pagenav,a.lcbtn{text-align:center}.bxh-menu{display:inline-block;width:33%;margin:auto}.bxh-menu a{color:#C9C9C9;background:0 0}.active a{color:#474747}.tkbh-top{padding:5px;color:#ADADAD;border-bottom:1px solid #F2F2F2;font-size:12px;font-style:normal!important}.tkbh-top h1{font-size:18px;color:#000}.btnind,.btnl,.tkbh-pagenav a{color:#fff;display:inline-block}.tkbh-pagenav a{padding:2px 5px;border-radius:3px;background:#5A13CD;margin:5px}.btnbox{margin-top:15px;margin-bottom:0}.btnind,.btnl{padding:8px 4px;background:rgba(6,86,234,1);border-radius:5px;font-size:13px;text-transform:capitalize;font-weight:400;margin:0 auto}#uptop a,.logo,.ytbtn{font-weight:700}.btnl{padding:8px 4px;margin:5px 10px}.btnind:before{content:url(/ico/home.png);display:inline-block;background-size:100% 100%;width:13px;height:13px}.logo,.logo img,.search,.search input{display:block}.logo{background:#1bb5f3;margin:-5px -5px 10px;min-width:30%;font-size:100%;padding:15px 2px}.logo img{max-width:300px;margin:auto}.logo a{padding:0;color:#38157A}.search{margin:10px 0;min-width:50%;overflow:hidden;border:0;box-sizing:border-box;background:0 0;padding:5px 0}.search form{margin:0}.cs,.ytbtn,.ytquery,a.lcbtn{margin-bottom:8px}.qr{border:0;height:30px;padding:5px;background:#fff}form#qr{padding:0;border:0}.search input{width:100%;height:36px;border:1px solid #5c1caf;border-radius:3px;background:0 0;padding:7px 30px 7px 5px;box-sizing:border-box;outline:0;font-size:15px}.search_arrow,.search_btn,a.lcbtn{display:inline-block}.search_btn{top:0;right:0;padding:0;position:absolute;width:90px;background:#5c1caf;color:#fff;height:36px;border:1px solid #5c1caf;border-top-right-radius:3px;border-bottom-right-radius:3px;outline:0}.search_arrow{width:0;height:0;border-top:10px solid transparent;border-bottom:10px solid transparent;border-right:0;border-left:15px solid #fff;background:0;position:absolute;top:13px;right:80px}.search_btn:active,.search_btn:visited{background:#3A0750}.red{color:red}.life{color:green}.cate{background:rgba(255,255,255,0);color:rgba(3,119,243,.99)!important;padding:10px}.ytquery{width:100%;box-sizing:border-box;height:40px;border:1px solid #530367;outline:0;margin-top:8px;padding:10px;border-radius:8px}.ytbtn{border-radius:4px;color:#fff;padding:5px 10px!important;background:#1895d4;border:1px solid #8fdcff;margin-top:8px;font-size:15px;line-height:15px;font-family:sans-serif;vertical-align:top}.ytbtn:hover{border-color:#000;color:#000}.cs{background:rgba(201,201,201,.39);color:#ff00e9;padding:3px;border:1px dashed green}.cs>a.lcbtn{float:none}a.lcbtn{padding:1px 4px;background:#000;color:#fff;font-size:13px;width:125px;border-radius:15px;float:right}.hide{display:none}#uptop{opacity:1;height:auto;position:fixed;right:15px;bottom:10px;z-index:999;transition:all 1s}#uptop a:hover{color:#444}.up_arrow{display:block;margin:-5px auto auto;font-size:20px;position:relative;width:0;height:0}.up_arrow:before{content:'';display:block;position:absolute;border:14px solid rgba(103,103,103,.42);border-left:22px solid transparent;border-right:23px solid transparent;border-top:0;top:-14px;left:-23px}#uptop a{color:#000;display:block;line-height:1em;padding:5px 5px 10px;background:rgba(103,103,103,.42);-webkit-box-shadow:0 1px 10px rgba(0,0,0,.05);-moz-box-shadow:0 1px 10px rgba(0,0,0,.05);box-shadow:0 1px 10px rgba(0,0,0,.05)}.ab a:visited{color:#0000b5}#suggest,#ytsuggest{overflow:auto}#suggest>ul,#ytsuggest>ul{margin:0;padding:0}#suggest>ul>li,#ytsuggest>ul>li{outline:0;cursor:pointer;border:1px solid rgba(201,201,201,.33);border-top:0;font-weight:700;padding:10px}#suggest>ul>li.active,#ytsuggest>ul>li.active{background-color:#f8f8f8}.progress{position:fixed;left:0;top:0;width:100%;z-index:9999;background-color:#F2F2F2}.progress>div{background-color:#04c9fd;width:0;height:3px;border-radius:3px}.lr-line::first-letter{text-transform:uppercase}.lr-line{box-sizing:border-box;padding:3px 0;line-height:19px;min-height:19px;vertical-align:middle}.dls:after{content:url(/ico/mb.jpg);padding-left:2px}#mainad{background-color:#fff;box-shadow:0 0 0 0 #000;margin:0 -5px}.game img{border:3px solid #ddd;border-radius:15px}
a#mp3ring {
    background: #2d7eb8;
    padding: 6px 10px;
    border-radius: 5px;
    color: #fff;
}
a#mp3ring:active {
    background: #000;
}
iframe#twitter-widget-0 {
    top: 0px;
    position: relative !important;
}
.fb-share-button.fb_iframe_widget.fb_iframe_widget_fluid, .fb-share-button.fb_iframe_widget {
    vertical-align:  top;
    top:  0 !important;
}

.fb-share-button.fb_iframe_widget.fb_iframe_widget_fluid>span, .fb-share-button.fb_iframe_widget>span{
    vertical-align:  top !important;
    top:  0 !important;
}
ul .item {
  padding: 10px;
  background: #ffffff;
  border-bottom: 1px solid #f5f5f5;
  display: flex;
}
ul .item .info {
  padding-bottom: 0 !important;
  border: none;
}
ul .item .thumbnail {
  min-width: 48px;
  max-width: 48px;
  height: 48px;
  background: #eee;
  margin-right: 5px;
  position: relative;
  overflow: hidden;
}

ul .item .thumbnail img {
  position: absolute;
  left: 50%;
  top: 0;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  height: 100%;
}

ul .loading .info {
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  padding-bottom: 0 !important;
  border: none;
}

ul .loading .info .line-lg,
ul .loading .info .line-md,
ul .loading .info .line-xs {
  height: 12px;
  display: flex;
  margin-bottom: 6px;
  -webkit-animation: timeline;
          animation: timeline;
  -webkit-animation-duration: 2s;
          animation-duration: 2s;
  -webkit-animation-timing-function: linear;
          animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
  background: linear-gradient(to right, #eeeeee 10%, #dddddd 20%, #eeeeee 30%);
  background-size: 1000px auto;
}

ul .loading .info .line-lg {
  width: 90%;
}

ul .loading .info .line-md {
  width: 30%;
}

ul .loading .info .line-xs {
  height: 12px;
  width: 50%;
  vertical-align: bottom;
  margin-bottom: 0;
}

ul .loading .thumbnail {
  -webkit-animation: timeline;
          animation: timeline;
  -webkit-animation-duration: 2s;
          animation-duration: 2s;
  -webkit-animation-timing-function: linear;
          animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
  background: linear-gradient(to right, #eeeeee 10%, #dddddd 20%, #eeeeee 30%);
  background-size: 1000px auto;
}

@-webkit-keyframes timeline {
  0% {
    background-position: -300px 0;
  }

  100% {
    background-position: 750px 0;
  }
}

@keyframes timeline {
  0% {
    background-position: -300px 0;
  }

  100% {
    background-position: 750px 0;
  }
}
</style>
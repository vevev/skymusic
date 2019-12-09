<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "https://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="vi">
<head>
    <link rel="stylesheet" href="" />
    <link rel="stylesheet" href="{{ asset("/fonts/css/fonts.css?v=" . config('app.version')) }}" media="screen" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="id" />
    <meta http-equiv="X-UA-Compatible" content="requiresActiveX=true" />
    <title>Tai nhac {{ $song->name }}</title>
    <link rel="shortcut icon" href="/ico/favicon.ico">
    <meta name="google-site-verification" content="QxV3ai5XAkkJe3kJ3DW6mFriXTsGgzvkie6J5hn_OX4" />
    @csrf
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="robots" content="noindex,follow" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
    body{background:#F2F2F2;font-family:sans-serif;margin:0}a#mp3ring{background:#2d7eb8;padding:6px 10px;border-radius:3px;color:#fff}a#mp3ring:active{background:#000}a{text-decoration:none}div#main{background:#fff;margin:10px auto;max-width:600px;border:1px solid #c5c5c5;padding:10px}.header{background:#1BB5F3;color:#fff;text-align:center;font-size:20px;font-weight:700;padding:10px 20px;border-bottom:1px solid #fff}.name{text-align:center;margin:0 auto;border-collapse:collapse;box-sizing:border-box}.name td{border:1px solid #d9d9d9;padding:11px}@keyframes changewidth{from{background:#3e1b7a}to{background:#cedfb1;color:#3e1b7a}}.dl3{animation-duration:2s;animation-name:changewidth;animation-iteration-count:infinite;animation-direction:alternate}.name tr>td:first-child{font-weight:700}.name tr:nth-child(2n){background:#f8f8f8}.btn-a,.btn-b,.btn-c{font-weight:700;color:#FFF;background:#1FCC00;border-radius:3px;padding:10px;font-size:15px!important;display:inline-block;border:1px solid transparent}.btn-a:active,.btn-b:active,.btn-c:active{color:#f70000;background:#fff;border:1px solid red}.btn-a>b:before,.btn-b>b:before,.btn-c>b:before{content:url(ico/dl.png);display:inline-block;vertical-align:top;line-height:15px;height:15px}.btn-b{background:#3e1b7a}.btn-c{background:#7a1b1b}.table{display:table;background-color:#fff;border-collapse:collapse;margin:5px auto;text-align:center;font-weight:700;border-radius:5px;width:99%}.td{padding:10px 2px;border:1px solid #d5d5d5}.back{display:inline-block;padding:6px 15px;#background:#045e38;background:linear-gradient(to right,#252cb7,#32d2bc);color:#fff;margin:10px auto;font-weight:700;border-radius:5px;position:relative}a.back:before{content:"\00ab";left:3px;top:4px;position:absolute;content:\00ab}.sub{background:#fff;color:#000;margin:10px -20px -15px;padding:5px 10px;box-shadow:0 0 10px 0 rgba(0,0,0,0.16)}div#footer{background:#D4D4D4;text-align:center;padding:20px 10px}img{max-width:250px}p{margin:0}.life{color:green}#mainad{background-color:#fff;box-shadow:0 0 0 0 #000;margin:0 -5px}.game img{border:3px solid #ddd;border-radius:15px}#button-convert-mp3 btn-a{font-weight:700;color:#FFF;background:#1FCC00;border-radius:3px;padding:10px;font-size:15px!important;display:inline-block;border:1px solid transparent;height:auto;width:auto;box-shadow:none}@keyframes changewidth{from{background:#3e1b7a}to{background:#cedfb1;color:#3e1b7a}}.dl3{animation-duration:2s;animation-name:changewidth;animation-iteration-count:infinite;animation-direction:alternate}#button-convert-mp3 button:hover{border-color:transparent;-webkit-box-shadow:0 1px 0 rgba(0,0,0,.1)none;box-shadow:none}
    </style>
</head>

<body>
    <div class="header">
        <a href="/"><img src="{{ asset('/images/tainhac.png') }}" alt="" /></a>
        <div class="sub">
            <p><i style="color: red; font-size: 14px
                ">Tai nhac mien phi...</i></p>
        </div>
    </div>
    <div id="main">
        <div class="main">
            <div id="vue-container" style="width: auto; max-width: 100%;">
                <table class="name">
                    <tbody>
                        <tr>
                            <td colspan="2">{{$song->name}}</td>
                        </tr>
                        <tr>
                            <td>File Type</td>
                            <td>Audio/mp3</td>
                        </tr>
                        <tr>
                            <td>Size</td>
                            <td id="fsize">
                                3-10 Mb
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="vue-container" style="width: auto; max-width: 100%;">
                                    <a class="btn-a" href="{{ route('download', ['slug'=>$song->slug, 'id'=>$song->song_id]) }}">
                                        <i class="icon-download"></i>
                                        DOWNLOAD
                                    </a>
                                </div>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td colspan="2">
                                <a href="/validate2.php?id=fflVjV7dA8s" class="btn-b">
                                    <b></b> DOWNLOAD 2
                                </a>
                            </td>
                        </tr> --}}
                        <tr>
                            <td colspan="2">
                                <div id="audio-player-container" data-src="{{route('listen', ['slug'=>$song->slug, 'id'=>$song->song_id])}}"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <center>
                <a onclick="window.history.back();" class="back" href="{{ Request::header('HTTP_REFERER', '/') }}">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>
            </center>
        </div>
    </div>
    <div id="footer">
        <p class="center">
            <span class="life">▂ ▅ ▇ ♪♫ MUSIC IS MY LIFE ♪♫ ▇ ▅ ▂</span><br><br>
            <a href="/"><img src="/images/icon-tainhac.png" width="50px"></a><br>
            <b><a href="/">Tai nhac 123</a></b></br><br>
            Contact: ad.tainhac123@gmail.com<br>
        </p>
    </div>
    <script type="text/javascript" src="{{ asset("/js/app.min.js?v=" . config('app.version')) }}"></script>

</body>

</html>

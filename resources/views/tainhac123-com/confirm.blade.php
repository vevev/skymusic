<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "https://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="vi">
<head>
    <link rel="stylesheet" href="" />
    <link rel="stylesheet" href="{{ asset("/fonts/css/fonts.css?v=" . config('app.version')) }}" media="screen" />
    @if(Page::$NO_INDEX)
    <meta name="robots" content="noindex">
    @endif
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="vi" />
    <meta http-equiv="X-UA-Compatible" content="requiresActiveX=true" />
    <title>Tải bài hát {{ $song->name }}</title>
    <link rel="shortcut icon" href="/images/favicon.ico">
    <meta name="google-site-verification" content="eYW7hlOMPEryvJXAOdwvh-Q0Hln63WENSZrhbfmlgbg" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="robots" content="noindex,follow" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
    body{background:#F2F2F2;font-family:sans-serif;margin:0}a#mp3ring{background:#2d7eb8;padding:6px 10px;border-radius:3px;color:#fff}a#mp3ring:active{background:#000}a{text-decoration:none}div#main{background:#fff;margin:10px auto;max-width:600px;border:1px solid #c5c5c5;padding:10px}.header{background:#1BB5F3;color:#fff;text-align:center;font-size:20px;font-weight:700;padding:10px 20px;border-bottom:1px solid #fff}.name{text-align:center;margin:0 auto;border-collapse:collapse;box-sizing:border-box}.name td{border:1px solid #d9d9d9;padding:11px}@keyframes changewidth{from{background:#3e1b7a}to{background:#cedfb1;color:#3e1b7a}}.dl3{animation-duration:2s;animation-name:changewidth;animation-iteration-count:infinite;animation-direction:alternate}.name tr>td:first-child{font-weight:700}.name tr:nth-child(2n){background:#f8f8f8}.btn-a, .btn-b, .btn-c {
    font-weight: 700;
    color: #FFF;
    background: #04bc0f;
    padding: 6px 20px;
    border-radius: 3px;
    font-size: 15px!important;
    display: inline-block;
    border: 1px solid transparent;
}.btn-a:active,.btn-b:active,.btn-c:active{color:#f70000;background:#fff;border:1px solid red}.btn-a>b:before,.btn-b>b:before,.btn-c>b:before{content:url(ico/dl.png);display:inline-block;vertical-align:top;line-height:15px;height:15px}.btn-b{background:#3e1b7a}.btn-c{background:#7a1b1b}.table{display:table;background-color:#fff;border-collapse:collapse;margin:5px auto;text-align:center;font-weight:700;border-radius:5px;width:99%}.td{padding:10px 2px;border:1px solid #d5d5d5}.back{display:inline-block;padding:6px 15px;#background:#045e38;background:linear-gradient(to right,#252cb7,#32d2bc);color:#fff;margin:10px auto;font-weight:700;border-radius:5px;position:relative}a.back:before{content:"\00ab";left:3px;top:4px;position:absolute;content:\00ab}.sub{background:#fff;color:#000;margin:10px -20px -15px;padding:5px 10px;box-shadow:0 0 10px 0 rgba(0,0,0,0.16)}div#footer{background:#D4D4D4;text-align:center;padding:20px 10px}img{max-width:250px}p{margin:0}.life{color:green}#mainad{background-color:#fff;box-shadow:0 0 0 0 #000;margin:0 -5px}.game img{border:3px solid #ddd;border-radius:15px}#button-convert-mp3 btn-a{font-weight:700;color:#FFF;background:#1FCC00;border-radius:3px;padding:10px;font-size:15px!important;display:inline-block;border:1px solid transparent;height:auto;width:auto;box-shadow:none}@keyframes changewidth{from{background:#3e1b7a}to{background:#cedfb1;color:#3e1b7a}}.dl3{animation-duration:2s;animation-name:changewidth;animation-iteration-count:infinite;animation-direction:alternate}#button-convert-mp3 button:hover{border-color:transparent;-webkit-box-shadow:0 1px 0 rgba(0,0,0,.1)none;box-shadow:none}h1.ht.song{border-bottom:0;padding-bottom:0}.collapse-view-more{display:none;width:100%;height:40px;line-height:20px;padding:10px;position:absolute;cursor:pointer;bottom:0;color:#065fd4;text-decoration:underline}.menu{display:block;height:100%;padding:10px 0;margin:0 10px;overflow:hidden;border:none;border-bottom:1px solid #ededed}.menu:last-child,.menu:last-of-type{border-bottom:none}.menu:first-child,.menu:nth-first-of-type(1){padding-top:0}.menu:last-child{border:0}.menu p{margin-left:38px}.menu span[itemprop=text]{color:#666}.detail-thumb{margin-left:0;float:left;display:block;border-radius:60px;font-size:10px;color:#888;line-height:1;text-align:justify;box-shadow:0 0 3px 0 #c6c6c6}.detail-thumb,.detail-thumb img{width:60px;height:60px;overflow:hidden}.detail-thumb img{vertical-align:middle;padding:0;box-sizing:border-box;border-radius:2px}.gt{background:#fff;padding:10px;border-radius:3px;box-shadow:0 0 1px 1px rgba(94,94,94,.04);margin-top:10px}.detail-info{margin-left:70px;min-height:60px;box-sizing:border-box;vertical-align:middle;display:block}.listen:before{content:""}.info{border-bottom:1px solid #e9e9e9;padding-bottom:30px}.info h2{font-size:17px}.sg,.sg a{color:#606060;font-size:11px;margin:0;display:block;box-sizing:border-box}.sg b{font-weight:400;font-size:12px;display:block;white-space:nowrap;text-overflow:ellipsis;overflow:hidden}.sg b:before{color:#ccc}.ab a,.ht:first-child{margin-top:0}.play-count{padding:1px;font-weight:400;font-size:12px}.play-count:before{content:"ꀁ";font-family:fonts;padding-right:5px}.single{padding:1px;font-weight:400;font-size:12px}.single:before{content:"ꀢ";font-family:fonts;padding-right:5px}.ab a{color:#00f;font-size:16px;font-weight:600;line-height:1.25;overflow:hidden;max-height:16px;-webkit-line-clamp:1;white-space:normal;display:-webkit-box;max-height:44px;-webkit-line-clamp:2;-webkit-box-orient:vertical}.ht{display:block;padding:0 10px 10px;color:#000;font-size:18px;text-transform:none;border-bottom:1px solid #ededed;background:0 0}h1.ht{padding-top:10px;text-transform:capitalize}
    </style>
    @if($__core->mobileDetect->isMobile())
    <script data-ad-client="ca-pub-6109538742955032" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    @endif
</head>

<body>
    <div class="header">
        <a href="/"><img src="{{ asset('/images/tainhac.old.png?v=' . config('app.version')) }}" alt="" /></a>
        <div class="sub">
            <p><i style="color: red; font-size: 14px"><marquee>Tải nhạc miễn phí về máy</marquee></i></p>
        </div>
    </div>
    <div style="margin-bottom: 8px"></div>
    {{-- @if(Page::$IS_ADSENSE)
    <p align="center">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- thichungsk -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6109538742955032"
         data-ad-slot="1881633786"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    </p>
    @elseif($song->canDownload && $__core->mobileDetect->isMobile())
    <p align="center">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- thichungkpsk -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6109538742955032"
     data-ad-slot="9706253107"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    </p>
    @endif --}}
    <div id="main">
        <div class="main">
            <div>
                <table class="name" class="hello">
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
{{--                                         <i class="icon-download"></i> --}}
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
            <br>
            <div class="ht"><b>Bài hát hay liên quan :</b></div>
            <div class="collapse-menu">
            @foreach($song->relates as $num=>$relateSong)
            @if($num > 9)
            @break
            @endif
            <div class="menu">
                <div class="detail-thumb thumb">
                    <a href="{{ route('song', ['slug'=>$relateSong->slug, 'id'=>$relateSong->song_id]) }}" title="Tải bài hát {{ $relateSong->name }} Mp3">
                        <img src="{{ $relateSong->thumbnail }}" alt="Tải bài hát {{ $relateSong->name }} Mp3" title="Tải bài hát {{ $relateSong->name }} Mp3" src="{{ asset('/images/audio_default.png') }}" />
                    </a>
                </div>
                <div class="detail-info">
                    <b class="ab ellipsis dli block">
                        <a href="{{ route('song', ['slug'=>$relateSong->slug, 'id'=>$relateSong->song_id]) }}" title="Tải bài hát {{ $relateSong->name }} Mp3">
                            {{ $relateSong->name }}
                        </a>
                    </b>
                    <span class="sg">
                        <b class="single">{{ $relateSong->single }}</b>
                        @if($relateSong->listen)
                        <b class="play-count">{{ $relateSong->listen }}</b>
                        @endif
                    </span>
                </div>
            </div>
            @endforeach
            <p class="collapse-view-more">Xem Thêm ...</p>
            </div>

                {{-- @if($song->hasSkymusic)
                <p align="center">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- thichungsk -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-6109538742955032"
                     data-ad-slot="1881633786"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                     (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                </p>
                <br>
                @elseif($song->canDownload && $__core->mobileDetect->isMobile())
                <p align="center">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- thichungkpsk -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6109538742955032"
     data-ad-slot="9706253107"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                </p>
                <br>
                @endif --}}
                <div class="pc90">
                    <div class="header_info">
                        <p class="tip">
                            <b>Gợi ý: </b>Nhập tên bài hát vào ô tìm kiếm để tìm &amp; tải miễn phí bất kỳ bài hát nào bạn muốn tải về máy.<br>
                        </p>
                    </div>
                    <div id="search-form" action="{{ route('search-post') }}" query="{{ !isset($query) ? '' : $query }}" suggest-route="{{ route('search', ['query_string' => '']) }}">
            <style type="text/css">@charset "UTF-8";
form[role=search]{display:block;width:100%}form div#search-input{display:-webkit-box;display:flex;position:relative}form div#search-input button,form div#search-input input{border:none;background:#fff;margin:0;padding:0;outline:0;padding:5px 5px}form div#search-input input{width:100%;padding:10px;padding-right:55px;font-size:15px;background:#fff;border-radius:3px;border:1px solid #ced4da}form div#search-input button{position:absolute;height:100%;right:0;background:0 0}form div#search-input .search-btn{background:#007bff;color:#fff;border-top-right-radius:3px;border-bottom-right-radius:3px;padding:0 20px;font-size:16px;font-weight:600}form div#search-input .search-btn:before{content:"ꀅ";font-family:fonts;width:25px;display:none;font-size:14px}form div#search-input .cancel-btn:before{content:"ꀓ";font-family:fonts;width:25px;display:block}form div#search-input ul#suggest-result{position:absolute;z-index:10;top:40px;width:100%;background:#fdfdfd;box-shadow:0 5px 10px -2px #cecece;border:1px solid #ebebeb;border-radius:3px;overflow:hidden;padding:3px 0}form div#search-input ul#suggest-result li{padding:6px 5px}form div#search-input ul#suggest-result li a{color:#333;text-decoration:none}form div#search-input ul#suggest-result .active{background:#00a0e0}form div#search-input ul#suggest-result .active a{color:#fff}
</style>
            <form role="search" action="{{ route('search-post') }}" method="POST" class="form">
                @csrf
                <div id="search-input" class="input-group">
                    <input autocomplete="off" type="text" value="" name="q" placeholder="Nhập tên bài hát rồi bấm nút TÌM..." class="form-control">
                    <button type="submit" class="btn search-btn">TÌM</button>
                </div>
            </form>
        </div>

                    <div class="clear"></div>
                </div>
            <center>
                <a onclick="window.history.back();" class="back" href="{{ Request::header('referer', '/') }}">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>
            </center>
        </div>
    </div>
    <div id="footer">
        <p class="center">
            <span class="life">▂ ▅ ▇ ♪♫ MUSIC IS MY LIFE ♪♫ ▇ ▅ ▂</span><br><br>
            <a href="/"><img src="/images/icon-tainhac.png" width="50px"></a><br>
            <b><a href="/">TaiNhac123.Com</a></b>
            @if(Page::$IS_ADSENSE)
            Bản quyền nội dung cung cấp bởi <b><a rel="nofollow" target="_blank" href="https://skymusic.com.vn/">SkyMusic</a></b>
            @endif
            </br><br>
            Contact: ad.tainhac123@gmail.com<br>
            <a href="/disclaimers.html" style="color:blue">Giới thiệu và Điều khoản</a>
        </p>
    </div>
    <script type="text/javascript" src="{{ asset("/js/app.min.js?v=" . config('app.version')) }}"></script>

</body>

</html>

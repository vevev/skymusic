<div id="header">
    <div class="container-default">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=561502204050887";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="logo center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/tai-nhac.png') }}" alt="Tải nhạc miễn phí" />
            </a>
        </div>
        <a href="{{ route('home') }}">
            <h1 class="f18 justify red center" title="Tải nhạc miễn phí. Tải nhạc mp3 hay nhất, mới nhất">Tải nhạc miễn phí. Tải nhạc mp3 hay nhất, mới nhất</h1>
        </a>
        <div class="search">
            <u>Hướng dẫn tải nhạc</u> : nhập tên <b>bài hát</b> vào ô bên dưới rồi nhấn nút <b>Tìm bài hát</b> để tải nhạc về máy.
            <form id="qr" action="{{ route('form-url-search') }}" method="get">
                <input id="q" type="text" name="q" placeholder="Nhập tên bài hát..." />
                <button type="submit" class="search_btn">Tìm Bài Hát</button>
            </form>
        </div>
    </div>
    @if(!Route::is('home'))
        <div id="nav-none-main">
            <div class="container-default">
                <div class="nav-menu">
                    <a href="{{ route('bxh-song-vn') }}">nhạc hay</a>
                    <a href="{{ route('bxh-song-vn') }}">top 100</a>
                    <a href="{{ route('bxh-song-vn') }}">chủ đề</a>
                    <a href="{{ route('bxh-song-vn') }}">album</a>
                </div>
            </div>
        </div>
    @endif
</div>


@if(Route::is('home'))
<div id="nav-main-menu" class="container-default margin-block">
    <div class="top-menu">
        <div class="top-menu-item-first"><h2>Tải Nhạc Hay</h2></div>
            <div class="top-menu-item"><span class="btn"></span> <a href="{{ route('bxh-song-vn') }}" title="Nhạc Sơn Tùng MTP Hay Nhất">Tải Nhạc Sơn Tùng MTP</a></div>
            <div class="top-menu-item"><span class="btn"></span> <a href="{{ route('bxh-song-vn') }}" title="Tải nhạc hay nhất">Tải nhạc hay nhất tuần</a></div>
            <div class="top-menu-item"><span class="btn"></span> <a href="{{ route('bxh-song-vn') }}" title="Tải nhạc trong TOP 100 bài hát hay nhất">Tải nhạc trong top 100</a></div>
            <div class="top-menu-item"><span class="btn"></span> <a href="{{ route('bxh-song-vn') }}" title="Tải nhạc theo album mới và thịnh hành">Tải nhạc theo album</a>
        </div>
    </div>
</div>
@endif

<div id="main">
@yield('ads_under_header')

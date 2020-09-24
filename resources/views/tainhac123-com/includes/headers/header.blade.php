<div id="header">
    <div class="logo">
        <a href="/" id="logowrapper">
            <img src="{{ asset(Page::$logo['src'] ?? '/images/tainhac.png?v=' . config('app.version')) }}" alt="{{ Page::$logo['alt'] ? Page::$logo['alt'] : 'Tainhac123 - Tải nhạc mp3 miễn phí - Tai nhac 123' }}" />
        </a>
        <script type="text/javascript">
            var logowrapper = document.getElementById('logowrapper');
            var execAnimate = e => {
                logowrapper.classList.add('actived')
            }
            @if($__core->isAnimateLogo())
            document.addEventListener("DOMContentLoaded", execAnimate);
            @else
            execAnimate();
            @endif
        </script>
    </div>
    <div class="pc90">
        <div class="header_info">
            <h1 class="slog">
                <a href="/">Tải Nhạc MP3 Miễn Phí CỰC NHANH Về Điện Thoại</a>
            </h1>
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
</div>
@yield('ads_under_header')
<div id="main">

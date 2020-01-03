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
        <div id="search-form" action="{{ route('search-post') }}" query="{{ !isset($query) ? '' : $query }}" suggest-route="{{ route('search', ['query_string' => '']) }}"></div>

        <div class="clear"></div>
    </div>
</div>
<div id="main">

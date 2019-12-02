<div id="header">
    @if (Page::$currentRouteName === 'index')
    <div class="logo">
        <div class="pc90">
            <a href="/">
                <img src="/ico/{{ Page::$logo['src'] ? Page::$logo['src'] : 'download-lagu-123.png' }}" alt="{{ Page::$logo['alt'] ? Page::$logo['alt'] : 'Download lagu Mp3, Gudang lagu - Mp3 download lagu terbaru 2019' }}" />
            </a>
        </div>
    </div>
    @else
    <div class="logo">
        <div class="pc90">
            <a href="/">
                <img src="/ico/{{ Page::$logo['src'] ? Page::$logo['src'] : 'download-lagu-123.png' }}" alt="{{ Page::$logo['alt'] ? Page::$logo['alt'] : 'Download lagu, Gudang lagu - download lagu terbaru 2019' }}" />
            </a>
        </div>
    </div>
    @endif
    <div class="pc90">
        <div class="header_info">
            <h1 class="f18 center">
                <a href="https://downloadlagu123.mobi/">Tải Nhạc MP3 Miễn Phí CỰC NHANH Về Điện Thoại</a>
            </h1>
            <br><b>Gợi ý: </b>Nhập tên bài hát vào ô tìm kiếm để tìm &amp; tải miễn phí bất kì bài hát nào bạn muốn tải về máy.<br>
        </div>
        <div class="search">
            <form id="qr" action="{{ route('search-post') }}" method="post">
                <input id="q" type="text" name="q" placeholder="Nhập tên bài hát rồi bấm nút TÌM..." />
                @csrf
                <button type="submit" class="search_btn" title="Cari Lagu">TÌM</button>
            </form>
            <i class="search_arrow"></i>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="main">

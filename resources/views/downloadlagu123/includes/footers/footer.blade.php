<div class="clear"></div>
@yield('adsense')
</div><br>
<div class="btnbox">
@if (Page::$currentRouteName !== 'index')
<br />
<a href="/"  title="Tải nhạc mp3 miễn phí" class="btnind center">Trang Chủ</a>
</div><br />
@endif

<div id="footer">
	@if (Route::is('index'))
    <div class="center">
    	<h3 class="f15">Trang web tải bài hát hay mới nhất. Download nhạc mp3 - kho bài hát miễn phí</h3>
    </div>
	<br>
	<p align="center">
		<b><a href="/">TaiNhac123.Com</a></b> là trang web <i><u>Tải nhạc Mp3 Miễn Phí</u></i> về thẻ nhớ cho máy Samsung, Oppo, Iphone ... Tải nhạc mp3 chất lượng cao, trang web cập nhật bảng xếp hạng âm nhạc chính xác và nhanh nhất,  kho bài hát lớn nhất có thể đáp ứng tất cả các nhu cầu của bạn, là lựa chọn hàng đầu cho bạn.
	</p>
	<br>
	@endif
<p class="center">
  <a href="/" aria-label="Tải nhạc mp3 miễn phí"><img src="/images/icon-tainhac.png" width="50px" alt="Tải nhạc 123"></a><br>
<b><a href="/">TaiNhac123</a></b> <font size="4">✪</font><br>
@if(Page::$IS_ADSENSE)
Bản quyền nội dung cung cấp bởi <b><a rel="nofollow" href="https://skymusic.com.vn/" target="_blank">SkyMusic</a></b>
<br>
<br>
@endif
Contact: ad.tainhac123@gmail.com<br>
♪ <b>FULL SONG FOR YOU</b> ♫<br>
<font size="5">💖</font>
<br>
<a href="/disclaimers.html" style="color:blue">Giới thiệu và Điều khoản</a><br>
<a href="/sitemap.xml" style="color:blue">SITEMAP</a>
</p>
</div>

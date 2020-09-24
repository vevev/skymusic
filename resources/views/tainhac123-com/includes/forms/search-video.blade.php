<div class="yts">
<font color="red" size="4"><b>&nbsp;&nbsp;Save Video & Musik Dari Youtube:</b></font>
<div class="search">
            <form id="qr" action="/search-video/" method="get">
                <input id="q" type="text" name="q" placeholder="Masukkan nama video..." autocomplete='off' />
                <button type="submit" class="search_btn">CARI</button>
            </form>
            <i class="search_arrow"></i>
 </div>
 </div>

@if (Page::$currentRouteName == 'index' && @$__seo)
<div class="yts">
Kata kunci Google: <b>Download <?=$op->data['name']?>, Download lagu <?=$op->data['name']?> - MP3</b>
</div>
@endif

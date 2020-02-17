@extends('downloadlagu123.layouts.app')

@section('section')
@if($__core->mobileDetect->isMobile())
<p style="text-align: center; margin: 10px auto">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Qc ngang 123 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-6109538742955032"
     data-ad-slot="6349445803"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</p>
@endif
@endsection

@section('content')
<div class="left-bar">
    <div class="cate">
        <h2 class="ht">Tải Nhạc Mp3 Hay - BXH</h2>
    </div>
    {{-- <div class="collapse-menu"> --}}
    @foreach($data['main'] as $index => $song)
    <div class="menu">
        <div class="detail-thumb thumb">
            <a title="Tải bài hát {{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                <img alt="Tải bài hát {{ $song['name'] }}" title="Tải bài hát {{ $song['name'] }}" data-src="{{ $song['thumbnail'] }}" src="{{ asset('/images/audio_default.png') }}" />
            </a>
        </div>
        <div class="detail-info">
            <h3 class="ab ellipsis dli">
                <a title="Tải bài hát {{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">{{ $song['name'] }}</a>
            </h3>
            <span class="sg">
                <b class="single">{{ $song['single'] }}</b>
                @if($song['listen'])
                <b class="play-count">{{ $song['listen'] }}</b>
                @endif
            </span>
        </div>
    </div>
    @endforeach
    {{-- <p class="collapse-view-more">Xem Thêm ...</p>
    </div> --}}
</div>
@endsection

@section('sidebar')
{{--     <div class="right-bar">
        <div class="cate">
            <b class="ht">Tải Nhạc Mp3 Hay khác</b>
        </div>
        <div class="collapse-menu">
        @foreach($data['sidebar']['primary'] as $song)
        <div class="menu">
            <div class="detail-thumb thumb">
                <a title="Tải bài hát {{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                    <img alt="Tải bài hát {{ $song['name'] }}" title="Tải bài hát {{ $song['name'] }}" data-src="{{ $song['thumbnail'] }}" src="{{ asset('/images/audio_default.png') }}" />
                </a>
            </div>
            <div class="detail-info">
                <h3 class="ab ellipsis dli">
                    <a title="Tải bài hát {{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">{{ $song['name'] }}</a>
                </h3>
                <span class="sg">
                    <b class="single">{{ $song['single'] }}</b>
                    @if($song['listen'])
                    <b class="play-count">{{ $song['listen'] }}</b>
                    @endif
                </span>
            </div>
        </div>
        @endforeach
        <p class="collapse-view-more">Xem Thêm ...</p>
        </div>
    </div> --}}
    <div class="right-bar">
        <div class="cate">
            <b class="ht">Tải Nhạc Mp3 Hay khác</b>
        </div>
        <div class="collapse-menu">
            @php
                $songs = json_decode('[{"song_id":"5aki2rRJ3VHh","name":"G\u00e1i Gi\u00e0 Mu\u1ed1n L\u1ea5y Ch\u1ed3ng","slug":"gai-gia-muon-lay-chong-ninh-duong-lan-ngoc","single":"Ninh D\u01b0\u01a1ng Lan Ng\u1ecdc","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/11\/25\/4\/e\/8\/9\/1574667073536.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-gai-gia-muon-lay-chong-ninh-duong-lan-ngoc-mp3\/5aki2rRJ3VHh.html","listen":0},{"song_id":"j3awUEpymF4A","name":"D\u00f9 M\u01b0a Th\u00f4i R\u01a1i","slug":"du-mua-thoi-roi-thuy-chi","single":"Th\u00f9y Chi","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/11\/22\/b\/b\/d\/7\/1574419227694.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-du-mua-thoi-roi-thuy-chi-mp3\/j3awUEpymF4A.html","listen":0},{"song_id":"ZDCRe8cfDdoy","name":"I\'m Still Loving You","slug":"im-still-loving-you-noo-phuoc-thinh","single":"Noo Ph\u01b0\u1edbc Th\u1ecbnh","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/11\/13\/3\/c\/9\/4\/1573628650505.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-im-still-loving-you-noo-phuoc-thinh-mp3\/ZDCRe8cfDdoy.html","listen":0},{"song_id":"iGFAaIkxyXe3","name":"T\u1ef1 T\u00e2m","slug":"tu-tam-nguyen-tran-trung-quan","single":"Nguy\u1ec5n Tr\u1ea7n Trung Qu\u00e2n","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/10\/28\/e\/b\/a\/c\/1572250968573.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-tu-tam-nguyen-tran-trung-quan-mp3\/iGFAaIkxyXe3.html","listen":0},{"song_id":"c1TTbgotXL9T","name":"N\u00e0y Em G\u00ec \u01a0i","slug":"nay-em-gi-oi-nguyen-khoa-ft-lang-ld","single":"Nguy\u1ec5n Khoa,L\u0103ng LD","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/11\/14\/e\/3\/1\/6\/1573700670388.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-nay-em-gi-oi-nguyen-khoa-ft-lang-ld-mp3\/c1TTbgotXL9T.html","listen":0},{"song_id":"ZL3N1InExMvS","name":"B\u1ea1n T\u00ecnh \u01a0i","slug":"ban-tinh-oi-yuni-boo-ft-goctoi-mixer","single":"Yuni Boo, Goctoi Mixer","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/11\/18\/b\/0\/e\/0\/1574064395799.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-ban-tinh-oi-yuni-boo-ft-goctoi-mixer-mp3\/ZL3N1InExMvS.html","listen":0},{"song_id":"AHX2SHdodJlR","name":"Nghe N\u00f3i Anh S\u1eafp K\u1ebft H\u00f4n","slug":"nghe-noi-anh-sap-ket-hon-van-mai-huong-ft-bui-anh-tuan","single":"V\u0103n Mai H\u01b0\u01a1ng, B\u00f9i Anh Tu\u1ea5n","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/10\/23\/7\/8\/b\/5\/1571804802390.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-nghe-noi-anh-sap-ket-hon-van-mai-huong-ft-bui-anh-tuan-mp3\/AHX2SHdodJlR.html","listen":0},{"song_id":"TAqmd5IhCOeq","name":"Duy\u00ean \u00c2m","slug":"duyen-am-hoang-thuy-linh","single":"Ho\u00e0ng Th\u00f9y Linh","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/10\/18\/2\/0\/b\/1\/1571380779842.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-duyen-am-hoang-thuy-linh-mp3\/TAqmd5IhCOeq.html","listen":0},{"song_id":"fNLeUd3SjD7G","name":"\u0110i \u0110u \u0110\u01b0a \u0110i","slug":"di-du-dua-di-bich-phuong","single":"B\u00edch Ph\u01b0\u01a1ng","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/08\/28\/7\/4\/3\/a\/1566982655403.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-di-du-dua-di-bich-phuong-mp3\/fNLeUd3SjD7G.html","listen":0},{"song_id":"3ZQTDt8gdl4v","name":"So Close","slug":"so-close-binz-ft-phuong-ly","single":"Binz, Ph\u01b0\u01a1ng Ly","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/08\/24\/d\/b\/4\/2\/1566636272362.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-so-close-binz-ft-phuong-ly-mp3\/3ZQTDt8gdl4v.html","listen":0},{"song_id":"Wbl0lGylnp5A","name":"Cao \u1ed0c 20","slug":"cao-oc-20-b-ray-ft-dat-g","single":"B Ray, \u0110\u1ea1t G","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/06\/22\/b\/1\/2\/7\/1561218264960.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-cao-oc-20-b-ray-ft-dat-g-mp3\/Wbl0lGylnp5A.html","listen":0},{"song_id":"9fwJSQ0DA2kG","name":"Em N\u00f3i Anh R\u1ed3i","slug":"em-noi-anh-roi-chi-pu","single":"Chi Pu","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/08\/02\/d\/5\/b\/1\/1564742395489.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-em-noi-anh-roi-chi-pu-mp3\/9fwJSQ0DA2kG.html","listen":0},{"song_id":"vtEybe9NxLw7","name":"H\u00e3y Trao Cho Anh","slug":"hay-trao-cho-anh-son-tung-m-tp-ft-snoop-dogg","single":"S\u01a1n T\u00f9ng M-TP, Snoop Dogg","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/07\/03\/7\/5\/b\/e\/1562137543919.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-hay-trao-cho-anh-son-tung-m-tp-ft-snoop-dogg-mp3\/vtEybe9NxLw7.html","listen":0},{"song_id":"PjAI2ghSt6iP","name":"S\u00e1ng M\u1eaft Ch\u01b0a","slug":"sang-mat-chua-truc-nhan","single":"Tr\u00fac Nh\u00e2n","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/08\/05\/1\/9\/9\/6\/1564990539735.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-sang-mat-chua-truc-nhan-mp3\/PjAI2ghSt6iP.html","listen":0},{"song_id":"tnvcYCYt7lmv","name":"T\u1eebng Y\u00eau","slug":"tung-yeu-phan-duy-anh","single":"Phan Duy Anh","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/07\/03\/7\/5\/b\/e\/1562146897414.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-tung-yeu-phan-duy-anh-mp3\/tnvcYCYt7lmv.html","listen":0},{"song_id":"RFuRYI9qpBjs","name":"Hai Tri\u1ec7u N\u0103m","slug":"hai-trieu-nam-den-ft-bien","single":"\u0110en, Bi\u00ean","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/06\/20\/5\/9\/0\/b\/1561001745463.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-hai-trieu-nam-den-ft-bien-mp3\/RFuRYI9qpBjs.html","listen":0},{"song_id":"23t8CRn2Zltx","name":"Truy\u1ec1n Th\u00e1i Y","slug":"truyen-thai-y-ngo-kien-huy-ft-masew","single":"Ng\u00f4 Ki\u1ebfn Huy, Masew","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/08\/26\/e\/b\/e\/c\/1566802836856.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-truyen-thai-y-ngo-kien-huy-ft-masew-mp3\/23t8CRn2Zltx.html","listen":0},{"song_id":"DLmXB4T5Yjpe","name":"Old Town Road (Remix)","slug":"old-town-road-remix-lil-nas-x-ft-billy-ray-cyrus","single":"Lil Nas X, Billy Ray Cyrus","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/04\/06\/5\/7\/2\/f\/1554544746706.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-old-town-road-remix-lil-nas-x-ft-billy-ray-cyrus-mp3\/DLmXB4T5Yjpe.html","listen":0},{"song_id":"OBuwGZur0eQ7","name":"No Guidance","slug":"no-guidance-chris-brown-ft-drake","single":"Chris Brown, Drake","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/06\/08\/c\/0\/0\/7\/1559994159798.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-no-guidance-chris-brown-ft-drake-mp3\/OBuwGZur0eQ7.html","listen":0},{"song_id":"aDc39c0C9ri2","name":"Without Me","slug":"without-me-halsey","single":"Halsey","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2018\/10\/08\/2\/d\/8\/1\/1538943108455.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-without-me-halsey-mp3\/aDc39c0C9ri2.html","listen":0},{"song_id":"ajAUIvl35gND","name":"Happier","slug":"happier-marshmello-ft-bastille","single":"Marshmello, Bastille","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2018\/08\/16\/b\/e\/b\/3\/1534430933999.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-happier-marshmello-ft-bastille-mp3\/ajAUIvl35gND.html","listen":0},{"song_id":"0Oy3aYmlXrij","name":"Con Calma","slug":"con-calma-daddy-yankee-ft-snow","single":"Daddy Yankee, Snow","thumbnail":"https:\/\/avatar-nct.nixcdn.com\/song\/2019\/01\/25\/9\/5\/e\/1\/1548397477908.jpg","detail_url":"https:\/\/skymusic.dev\/tai-bai-hat-con-calma-daddy-yankee-ft-snow-mp3\/0Oy3aYmlXrij.html","listen":0}]', true);
            @endphp
        @foreach($songs as $index => $song)
        @if($index >19)
        @continue
        @endif
        <div class="menu">
            <div class="detail-thumb thumb">
                <a title="Tải bài hát {{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">
                    <img alt="Tải bài hát {{ $song['name'] }}" title="Tải bài hát {{ $song['name'] }}" data-src="{{ $song['thumbnail'] }}" src="{{ asset('/images/audio_default.png') }}" />
                </a>
            </div>
            <div class="detail-info">
                <h3 class="ab ellipsis dli">
                    <a title="Tải bài hát {{ $song['name'] }}" href="{{ route('song', ['slug'=>$song['slug'], 'id'=>$song['song_id']]) }}">{{ $song['name'] }}</a>
                </h3>
                <span class="sg">
                    <b class="single">{{ $song['single'] }}</b>
                    @if($song['listen'])
                    <b class="play-count">{{ $song['listen'] }}</b>
                    @endif
                </span>
            </div>
        </div>
        @endforeach
        <p class="collapse-view-more">Xem Thêm ...</p>
        </div>
    </div>
@endsection

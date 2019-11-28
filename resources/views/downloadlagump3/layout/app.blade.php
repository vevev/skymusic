<!DOCTYPE html>
<html lang="id">
<head>
    @include('downloadlagump3.layout.includes.meta')
    @if($__core->mobileDetect->isMobile() && $__core->accessFromGoogle())
    	@if(random_int(0,1))
        <script type="text/javascript" src="{{ asset('/js/lgf1.js?v=' . config('app.version')) }}"></script>
        @else
        <script type="text/javascript" src="{{ asset('/js/lgf1.js?v=' . config('app.version')) }}"></script>
        @endif
    @endif
    @include('downloadlagump3.layout.includes.fbjs')
    @yield('adnow')
    @if(preg_match('#downloadlagu321#', $_SERVER['HTTP_HOST']))
        <meta name="robots" content="noindex">
    @endif
</head>
<body>
    <div id="header" class="scroll-down">
        <div id="container" class="container-fluid pl-0 pr-0">
            <nav class="navbar navbar-expand-md header-navbar navbar-light">
                <div class="navbar-brand mx-auto">
                    <a class="logo" href="/">
                        <img style="max-width: 300px; padding: 10px 0;" src="{{ asset('/images/download-lagu.png?v=' . config('app.version')) }}" title="Download Lagu Terbaik 2019, Gudang Lagu Mp3 Terbaru Gratis" alt="Download Lagu Terbaik 2019, Gudang Lagu Mp3 Terbaru Gratis">
                    </a>
                </div>
                <div class="d-flex flex-row" style="flex-grow: 1;">
                    <div class="order-0" style="flex-grow: 1;">
                        <div class="form">
                            <form class="my-2" role="search" action="{{route('search-post')}}" method="post">
                                {{csrf_field()}}
                                <div class="input-group input-group-lg" id="suggest">
                                    <input autocomplete="off" type="text" id="search-query" value="{{ !isset($query) ? '' : $query }}" class="form-control" name="q" placeholder="Masukkan nama lagu">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary search-btn">
                                            CARI
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div id="main" class="container px-0">
        @yield('id_main')
    </div>
    @yield('__seo')

    <div class="home-btn">
        <a href="/" title="Download Lagu Mp3 - Gudang lagu">Home</a>
    </div>

    <div id="footer">
        <div class="container-fluid bg-white">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="copyright">
                        <i>Gudang lagu Mp3 - Download Lagu MP3 Gratis, cepat, mudah dan yang stabil</i>
                        <br><br>
                        <strong>Download Lagu Terbaru 2019, Gudang Lagu Mp3 Gratis Terbaik 2019. Gudang musik, Free download mp3 Indonesia.</strong>
                    <p><b>Contact:</b> dlaguaku@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="scroll-top"><div class="icon"></div></div>
    <script type="text/javascript" src="{{ asset("/js/app.min.js?v=" . config('app.version')) }}"></script>
</body>
</html>

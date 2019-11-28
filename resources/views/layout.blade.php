<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="Language" content="Indonesia"/>
    <meta http-equiv="content-language" content="id"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("/fonts/css/fonts.css?v=" . config('app.version')) }}" media="screen" />
    <link rel="stylesheet" href="{{ asset("/css/app.min.css?v=" . config('app.version')) }}" media="screen" />
    <link rel="icon" href="/favicon.ico" type="image/gif" sizes="16x16">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')"/>
    @if(!in_array(Route::currentRouteName(), ['index', 'search']))
    <meta name="robots" content="noindex, nofollow">
    @endif
    <meta property="og:type" content="article" />
    <meta property="og:image" content="https://savefrom123.com/images/download-lagu-gratis.jpg" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:locale" content="id_ID"/>
    <meta name="geo.placename" content="Indonesia"/>
    <meta name="geo.position" content="-0.7892750;113.9213270"/>
    <meta name="geo.region" content="ID"/>
    <meta name="ICBM" content="-0.7892750, 113.9213270"/>
</head>
<body>
    <div class="container">
        <div id="page" class="col-lg-9">
            <div id="header" class="scroll-down px-3">
                <div class="sub-head">
                    <div class="logo-wrapper">
                        <a class="logo" href="/">
                            TAINHAC123.COM
                        </a>
                    </div>
                    {{-- <div class="menu-btn-wrapprer">
                        <label class="menu-btn" for="checkbox"> </label>
                    </div>
                    <input type="checkbox" id="checkbox" name="checkbox"> --}}
                    <div class="menu-head">
                        <a href="#" class="menu-item">BXH</a>
                        <a href="#" class="menu-item">Top Download</a>
                        <a href="#" class="menu-item">Trending</a>
                    </div>
                </div>
                <div id="search-form" action="{{ route('search-post') }}" query="{{ !isset($query) ? '' : $query }}"></div>
            </div>
            @yield('nav')
            <div id="main" class="bc">
                @yield('main_content')
                @yield('search_keywords')
            </div>
            <div id="footer">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset("/js/app.min.js?v=" . config('app.version')) }}"></script>
</body>
</html>

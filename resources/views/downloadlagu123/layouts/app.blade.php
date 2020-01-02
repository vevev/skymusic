{{ Page::$IS_ADSENSE = 0; }}
<!DOCTYPE html>
<html lang="vi">
<head>
    @include('downloadlagu123.includes.heads.head')
</head>
<body>
    @yield('before_body_script')
    <div id="page">
        @include('downloadlagu123.includes.headers.header')
        @include('downloadlagu123.includes.sections.section')
        @include('downloadlagu123.includes.contents.content')
        @include('downloadlagu123.includes.sidebars.sidebar')
        @include('downloadlagu123.includes.footers.footer')
    </div>
    @yield('after_body_script')
    <script type="text/javascript" src="{{ asset("/js/app.min.js?v=" . config('app.version')) }}"></script>
    @include('downloadlagu123.includes.script')
</body>
</html>

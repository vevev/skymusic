<!DOCTYPE html>
<html lang="vi">
<head>
    @include('trangtainhac-net.includes.heads.head')
</head>
<body>
    @yield('before_body_script')
    <div id="html">
        @include('trangtainhac-net.includes.headers.header')
        @include('trangtainhac-net.includes.sections.section')
        @include('trangtainhac-net.includes.contents.content')
        @include('trangtainhac-net.includes.sidebars.sidebar')
        @include('trangtainhac-net.includes.footers.footer')
    </div>
    @yield('after_body_script')
    <script type="text/javascript" src="{{ asset("/js/app.min.js?v=" . config('app.version')) }}"></script>
    @include('trangtainhac-net.includes.script')
</body>
</html>

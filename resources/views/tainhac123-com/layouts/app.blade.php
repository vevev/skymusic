<!DOCTYPE html>
<html lang="vi">
<head>
    @include('tainhac123-com.includes.heads.head')
</head>
<body>
    @yield('before_body_script')
    <div id="page">
        @include('tainhac123-com.includes.headers.header')
        @include('tainhac123-com.includes.sections.section')
        @include('tainhac123-com.includes.contents.content')
        @include('tainhac123-com.includes.sidebars.sidebar')
        @include('tainhac123-com.includes.footers.footer')
    </div>
    @yield('after_body_script')
    <script type="text/javascript" src="{{ asset("/js/app.min.js?v=" . config('app.version')) }}"></script>
    @include('tainhac123-com.includes.script')
</body>
</html>

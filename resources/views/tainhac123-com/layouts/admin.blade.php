<!DOCTYPE html>
<html lang="id">
<head>
    @include('tainhac123-com.includes.heads.head-admin')
</head>
<body>
    <div id="app">
        @yield('before_body_script')
        <header>
            @include('tainhac123-com.includes.headers.header-admin')
        </header>
        <nav>
             @include('tainhac123-com.includes.navs.nav-admin')
        </nav>
        <div id="wrapper-page">
            <div id="wrap-sidebar">
            @include('tainhac123-com.includes.sidebars.sidebar-admin')
            </div>
            <div id="wrap-content">
            @include('tainhac123-com.includes.sections.section-admin')
            @include('tainhac123-com.includes.contents.content-admin')
            </div>

        </div>
        <footer>
            <h1>FOOTER</h1>
        </footer>
        @yield('after_body_script')
    </div>
    <script type="text/javascript" src="{{ asset('js/base/app.js') }}?v={{ microtime() }}"></script>
</body>
</html>

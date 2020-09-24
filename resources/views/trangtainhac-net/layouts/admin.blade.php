<!DOCTYPE html>
<html lang="id">
<head>
    @include('trangtainhac-net.includes.heads.head-admin')
</head>
<body>
    <div id="app">
        @yield('before_body_script')
        <header>
            @include('trangtainhac-net.includes.headers.header-admin')
        </header>
        <nav>
             @include('trangtainhac-net.includes.navs.nav-admin')
        </nav>
        <div id="wrapper-page">
            <div id="wrap-sidebar">
            @include('trangtainhac-net.includes.sidebars.sidebar-admin')
            </div>
            <div id="wrap-content">
            @include('trangtainhac-net.includes.sections.section-admin')
            @include('trangtainhac-net.includes.contents.content-admin')
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

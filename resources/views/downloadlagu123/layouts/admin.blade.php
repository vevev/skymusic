<!DOCTYPE html>
<html lang="id">
<head>
    @include('downloadlagu123.includes.heads.head-admin')
</head>
<body>
    <div id="app">
        @yield('before_body_script')
        <header>
            @include('downloadlagu123.includes.headers.header-admin')
        </header>
        <nav>
             @include('downloadlagu123.includes.navs.nav-admin')
        </nav>
        <div id="wrapper-page">
            <div id="wrap-sidebar">
            @include('downloadlagu123.includes.sidebars.sidebar-admin')
            </div>
            <div id="wrap-content">
            @include('downloadlagu123.includes.sections.section-admin')
            @include('downloadlagu123.includes.contents.content-admin')
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

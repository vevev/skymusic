<!DOCTYPE html>
<html lang="id">
<head>
    @include('downloadlagump3.layout.includes.meta')
    <meta name="robots" content="noindex, nofollow">
    @include('downloadlagump3.layout.includes.fbjs')
</head>
<body>
    <div id="main" class="container">
        @yield('id_main')
    </div>
    <script>
        $(function(){
            app.init(route, args);
        });
    </script>

    <div id="scroll-top"><div class="icon"></div></div>
    @include('downloadlagump3.layout.includes.ga')
</body>
</html>

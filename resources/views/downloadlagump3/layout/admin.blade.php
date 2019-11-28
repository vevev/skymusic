<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="api-token" content="{{ Auth::user()->api_token }}" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('/css/admin.css') }}" media="screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')"/>
    <link rel="canonical" href="" />
</head>
<body>
    <div id="container" class="container">
        <div id="header" class="scroll-down p-3 d-flex">
            <a class="btn btn-primary btn-sm mr-3" href="{{ route('admin.genre.index') }}" role="button">The Loai</a>
            <a class="btn btn-primary btn-sm mr-3" href="{{ route('admin.most-download.index') }}" role="button">Tai Nhieu</a>
            <a class="btn btn-primary btn-sm mr-3" href="{{ route('admin.single.index') }}" role="button">Ca Si</a>
            <div id="vue-tool" class="d-inline-flex ml-auto">
                <tool></tool>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="main_content">
            <div class="row">
                @yield('sidebar')
                @yield('mainbar')
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ mix('/js/admin.js') }}"></script>
    @yield('vuejs')
    <script type="text/javascript">
        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('.dropdown-menu').click(function(event) {
                event.stopPropagation();
            });
        })
    </script>
</body>
</html>

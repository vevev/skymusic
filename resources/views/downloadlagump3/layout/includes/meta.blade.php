<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" href="/favicon.ico" type="image/gif" sizes="16x16">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="google-site-verification" content="qcHXYlFmIacWcnkz0OotUEizHy0Lo6aVY5pKxfYgQl4" />
<title>@yield('title')</title>
<meta property="og:type" content="article" />
<meta property="og:image" content="https://downloadlagu-mp3.net/images/download-lagu-gratis.jpg" />
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="@yield('description')" />
<meta name="Language" content="Indonesia"/>
<meta http-equiv="content-language" content="id"/>
<meta name="geo.placename" content="Indonesia"/>
<meta name="geo.position" content="-0.7892750;113.9213270"/>
<meta name="geo.region" content="ID"/>
<meta name="ICBM" content="-0.7892750, 113.9213270"/>
<meta property="og:locale" content="id_ID"/>
<meta name="description" content="@yield('description')"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" href="{{ asset('/css/app.min.css?v=' . config('app.version')) }}" media="screen" />
<link rel="stylesheet" href="{{ asset("/fonts/css/fonts.css?v=" . config('app.version')) }}" media="screen" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/webapp.js?v=' . config('app.version')) }}"></script>
@yield('meta_tag')
@yield('canonical')
@yield('lang')

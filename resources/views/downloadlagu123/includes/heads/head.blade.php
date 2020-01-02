<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="width" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<title>{{ Page::$title }}</title>
@if(Page::$NO_INDEX)
<meta name="robots" content="noindex">
@endif
<meta name="description" content="{{ Page::$description }}" />
<meta property="og:type" content="article" />
<meta property="og:image" content="{{ asset('/images/tai-nhac-123.jpg') }}" />
<meta property="og:title" content="{{ Page::$title }}" />
<meta property="og:description" content="{{ Page::$description }}" />
<link rel="shortcut icon" href="/images/favicon.ico">
<meta name="theme-color" content="#186f92">
<meta name="msapplication-navbutton-color" content="#186f92">
<meta name="apple-mobile-web-app-status-bar-style" content="#186f92">
<meta http-equiv="content-language" content="vi"/>
<link rel="canonical" href="{{ URL::current() }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="google-site-verification" content="eYW7hlOMPEryvJXAOdwvh-Q0Hln63WENSZrhbfmlgbg" />
@yield('meta')
@yield('link')
<link rel="stylesheet" href="{{ asset("/fonts/css/fonts.css?v=" . config('app.version')) }}" media="screen" />
<link rel="stylesheet" href="{{ asset("/css/app.min.css?v=" . config('app.version')) }}" media="screen" />
@yield('inject_script')
@yield('social')
{{-- @if(Page::$IS_ADSENSE)
<script data-ad-client="ca-pub-6109538742955032" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endif --}}

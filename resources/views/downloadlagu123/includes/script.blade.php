@if (Page::isGoogleSpeedInsights())
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137588084-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-137588084-1');
</script>
@endif
<div id="uptop">
<a href="#"><span class="up_arrow"></span>Top</a></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@if (Page::$currentRouteName == 'video')
<script src="/lib/audioxhr.js" async></script>
@endif
<script src="../../lib/jquery.min.js?v=1.1.8" async></script>
<script src="/lib/ads.js" async></script>
<link href="/static/fonts.css" rel="stylesheet" media="screen">

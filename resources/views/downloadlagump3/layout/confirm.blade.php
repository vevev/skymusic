<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"  media="screen"  async defer crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="/favicon.ico" type="image/gif" sizes="16x16">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="google-site-verification" content="qcHXYlFmIacWcnkz0OotUEizHy0Lo6aVY5pKxfYgQl4" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    <meta name="Language" content="Indonesia"/>
    <meta http-equiv="content-language" content="id"/>
    <meta name="geo.placename" content="Indonesia"/>
    <meta name="geo.position" content="-0.7892750;113.9213270"/>
    <meta name="geo.region" content="ID"/>
    <meta name="ICBM" content="-0.7892750, 113.9213270"/>
    <meta property="og:locale" content="id_ID"/>

    @yield('meta_tag')
    @yield('canonical')
    @yield('lang')
    <meta name="description" content="@yield('description')"/>
    <style type="text/css">
        body{background: #f2f2f2}
        #mainbar{background:#fff}
        .button-watch{    text-transform: uppercase;text-decoration: none !important;position: relative;color: #fff !important;display:block;padding:10px 10px;border:1px solid #fff;box-shadow:0 0 3px 0 #ccc;width:180px;cursor:pointer;font-weight:700;font-size:12px;text-align:center;border-radius:3px;transition:all .5s ease-in-out;margin:15px 5px}
        .button-watch:hover{text-decoration: none;background: #003eb3;border-color: #003eb3;}
        .bg-red{background:red}
        .bg-gray{background:#00cf2e}
        .bg-blue{background:#0090f6}
        .bg-v{background: #c05858;}
        .bg-orange{background:orange}
        .btn-center{margin-left:auto;margin-right:auto}
        img#bigt{display:block;margin:auto;width:220px}
        .line{border-bottom:1px solid #ccc;margin:10px 0}
        h1.title{font-size:17px;margin-top:10px}
        h3.subtitle{font-size:20px;margin-top:10px;text-align:center}
        p.meta_tag{margin:0;padding:0;color:#999; font-size: 13px;}
        .bg-type1 {background: #0d82ff;color: #ffffff;}
        #header {position: inherit;top: none;z-index: 0;background: none;box-shadow: none; width: 100%;display: block;}
        .footer{text-align: center;width: 100%;position: initial;background: #fefefe;border-top: 2px solid #e6e6e6;padding: 0 15px 20px 15px;}
        .footer p {margin: 10px 5px;}
        #main {margin-top: 0px;}
        #footer{margin: 0;}
        p.sl {white-space: normal;font-size: 14px;margin-top: 20px;}
        .load-percent {position:  absolute;font-size: 10px;font-weight: normal;font-style:  normal;line-height: 16px;height: 16px;vertical-align:  middle;border-radius: 10px;width: 30px;text-align:  center;display: none;background: #fffffe;color: #414141;top: 10px;right: 2px;}
        .ild{background:url(/images/ld.svg);width:20px;height:20px;margin-right:10px;float:left;display:none;vertical-align:text-bottom;position:absolute;left:10px}
        .backbtn:before,.homebtn:before{content:'\f015';font-family:FontAwesome;margin-right:5px;font-weight:400}
        .backbtn:before{content:'\f060'}
        .backbtn,.homebtn{display:block;font-style: normal;width:70px;text-align:center;margin:auto;margin-bottom:20px;margin-top:20px;color:#0070ff;font-size:15px;font-weight:700;border:1px solid #0070ff;border-radius:3px}
        .backbtn {background: #3e7cca;color: #fff;border: none;}
        ul#suggest-result{z-index: 1;position:absolute;top:38px;list-style:none;padding:0;width:100%;margin:0}
        ul#suggest-result li{background:#fdfdfd;padding:10px;border-bottom:1px solid #f1f1f1}
        ul#suggest-result b{font-weight:400}
        ul#suggest-result a{color:#000;font-weight:700;text-decoration:none}
        ul#suggest-result li.active{background:#f9f9f9!important;outline:none}
        div#suggest{position:relative}
    </style>
    <script type="text/javascript" src="{{ asset('/js/webapp.js?v=' . config('app.version')) }}"></script>
    <script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.8&appId=561502204050887";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
</head>
<body>

    <div id="header" class="scroll-down">
        <div id="container" class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 offset-md-2 offset-lg-2 col-sm-12 col-xs-12" style="
                background: #fefefe;
                border-bottom: 2px solid #e6e6e6;
                padding: 20px 0 10px 20px;
            ">
                    <nav class="navbar navbar-expand-md header-navbar navbar-light w-100 mx-auto" style="
            flex-direction: column;
        ">
                        <div class="navbar-brand mx-auto">
                            <a class="logo" href="/">
                                <b>DOWNLOADLAGU-MP3.NET</b>
                            </a>
                        </div>
                        <div class="w-100">
                            <div class="form">
                                <form class="" role="search" action="/search">
                                    <div class="input-group" id="suggest">
                                        <input autocomplete="off" type="text" id="search-query" class="form-control" name="q" placeholder="Masukkan nama lagu dan klik cari ...">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary search-btn">
                                                CARI
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <b><i><center style="color: red; font-size: 13px;">Save-Download lagu tombol below / dibawah...</center></i></b>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="main" class="container">
        @yield('id_main')
    </div>
    <div id="footer">
        <div id="container" class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 offset-md-2 offset-lg-2 col-sm-12 col-xs-12 footer">
                    <a href="/" class="homebtn" ">Home</a>
                    <p>Indonesia Download lagu gratis ke ponsel-mobile Oppo,Samsung, Asus, Xiaomi... Cepat, nyaman, stabil</p>
                    <p><b>© 2019 DownloadLagu-Mp3.Net</b></p>
                    <p>Free Download Mp3 & Video Music</p>
                    <p>Contact: dlaguaku@gmail.com</p>
                </div>
            </div>

        </div>
    </div>
    <div id="scroll-top"><div class="icon"></div></div>
    <script>
        $(function(){
            app.init('', [])
        })
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117100629-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-117100629-1');
    </script>

</body>
</html>

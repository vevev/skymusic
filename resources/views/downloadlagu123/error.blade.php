<html lang="id"><head>
<title>{{ $message }}</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
    body{
        padding: 10px;
    }
    div#error_wrapper {
        max-width: 600px;
        margin: 10px auto;
        border: 1px solid #eee;
        text-align: center;
        font-weight: 600;
        font-family: monospace;

    }

    .message {
        padding: 10px 20px;
        border-bottom: 1px solid #eee;
    }

    .foot-message {
        padding: 10px 20px;
        font-weight: 400;
    }
</style>
</head>
    <body>
        <div id="error_wrapper">
            <div class="message">{{ $message }}</div>
            <div class="foot-message">
                <a href="/">Nhấn vào đây</a> để trở về trang chủ
            </div>
        </div>
    </body>
</html>

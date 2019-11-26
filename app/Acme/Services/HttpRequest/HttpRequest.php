<?php

namespace App\Acme\Services\HttpRequest;

class HttpRequest
{
    private function curl(string $url, array $headers = [], string $cookie = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);

        if ( ! empty($cookie)) {
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        }

        return curl_exec($ch);
    }

    public function get(string $url)
    {
        $headers[] = "Accept-Language: vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";

        return $this->curl($url, $headers, public_path('cookie.txt'));
    }

    public function getFile(string $url)
    {
        $headers[] = "Accept-Language: vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
        $headers[] = "referer: https://www.nhaccuatui.com/bai-hat/cang-nho-cang-dau-to-khanh-an.ZKeZatFswpG.html";

        return $this->curl($url, $headers);
    }

    public function getJsonMobile(string $url)
    {
        $headers[] = "cookie: touchEnable=true";

        return $this->curl($url, $headers);
    }

    public function getMobile(string $url)
    {
        $headers[] = "Accept-Language: vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
        $headers[] = "referer: https://www.nhaccuatui.com/bai-hat/cang-nho-cang-dau-to-khanh-an.ZKeZatFswpG.html";
        $headers[] = "cookie: touchEnable=true";

        return $this->curl($url, $headers);
    }
}

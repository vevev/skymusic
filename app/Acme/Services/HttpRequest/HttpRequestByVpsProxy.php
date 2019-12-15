<?php

namespace App\Acme\Services\HttpRequest;

class HttpRequestByVpsProxy
{
    private function curl(string $url, array $headers = [], string $cookie = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://171.244.34.205:8888/url.php?' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);

        return curl_exec($ch);
    }

    public function get(string $url)
    {
        return $this->curl('method=get&url=' . base64_encode($url));
    }

    public function getFile(string $url)
    {
        return $this->curl('method=getFile&url=' . base64_encode($url));
    }

    public function getJsonMobile(string $url)
    {
        return $this->curl('method=getJsonMobile&url=' . base64_encode($url));
    }

    public function getMobile(string $url)
    {
        return $this->curl('method=getMobile&url=' . base64_encode($url));
    }
}

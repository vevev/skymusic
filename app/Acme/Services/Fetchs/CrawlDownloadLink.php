<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class CrawlDownloadLink
{
    public function __construct(HttpRequest $http_request)
    {
        $this->http_request = $http_request;
    }

    private function fetchHtml(string $song_id)
    {
        $url_format = 'https://www.nhaccuatui.com/download/song/%s_128';
        $url        = sprintf($url_format, $song_id);

        return $this->http_request->getFile($url);
    }

    private function fetchJson(string $key)
    {
        $url_format = 'https://www.nhaccuatui.com/ajax/get-media-info?key1=%s';
        $url        = sprintf($url_format, $key);

        return $this->http_request->getJsonMobile($url);
    }

    public function crawl(string $song_id)
    {
        $response = $this->fetchHtml($song_id);
        $json     = json_decode($response);

        try {
            return  ! $json->error_code ?
            $json->data->stream_url : $json->error_code;
        } catch (Throwable $e) {

        }
    }

    public function crawlLinkPlay(string $key)
    {
        $response = $this->fetchJson($key);
        $json     = json_decode($response);

        try {
            return $json->data->location;
        } catch (Throwable $e) {

        }
    }
}

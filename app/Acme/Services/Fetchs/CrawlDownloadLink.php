<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class CrawlDownloadLink
{
    /**
     * Constructs a new instance.
     *
     * @param      \App\Acme\Services\HttpRequest\HttpRequest  $http_request  The http request
     */
    public function __construct(HttpRequest $http_request)
    {
        $this->http_request = $http_request;
    }

    /**
     * Fetches a html.
     *
     * @param      string  $key  The song identifier
     *
     * @return     <type>  The html.
     */
    private function fetchIframe(string $key)
    {
        $url_format = 'https://www.nhaccuatui.com/flash/xml?html5=true&key1=%s';
        $url        = sprintf($url_format, $key);

        return $this->http_request->get($url);
    }

    /**
     * Fetches a html.
     *
     * @param      string  $song_id  The song identifier
     *
     * @return     <type>  The html.
     */
    private function fetchHtml(string $song_id)
    {
        $url_format = 'https://www.nhaccuatui.com/download/song/%s_128';
        $url        = sprintf($url_format, $song_id);

        return $this->http_request->getFile($url);
    }

    /**
     * Fetches a json.
     *
     * @param      string  $key    The key
     *
     * @return     <type>  The json.
     */
    private function fetchJson(string $key)
    {
        $url_format = 'https://www.nhaccuatui.com/ajax/get-media-info?key1=%s';
        $url        = sprintf($url_format, $key);

        return $this->http_request->getJsonMobile($url);
    }

    /**
     * { function_description }
     *
     * @param      string  $song_id  The song identifier
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function crawl(string $song_id)
    {
        try {

            $response = $this->fetchHtml($song_id);
            $json     = json_decode($response);

            if (isset($json->data->stream_url)) {
                return $json->data->stream_url;
            }
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * { function_description }
     *
     * @param      string  $key    The key
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function crawlLinkPlay(string $key)
    {
        $response = $this->fetchJson($key);
        $json     = json_decode($response);

        try {
            return $json->data->location;
        } catch (Throwable $e) {
        }
    }

    /**
     * Gets the link iframe.
     *
     * @param      string  $key    The key
     */
    public function getLinkIframe(string $key)
    {
        $xml_string = $this->fetchIframe($key);
        $regex      = '#<location>\W+?<!\[CDATA\[(.+?)\]\]>\W+?</location>#';
        if (preg_match($regex, $xml_string, $matches)) {
            return $matches[1];
        }
    }
}

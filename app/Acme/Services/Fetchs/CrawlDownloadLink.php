<?php

namespace App\Acme\Services\Fetchs;

use stdClass;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Acme\Services\HttpRequest\HttpRequestByVpsProxy;

class CrawlDownloadLink
{

    /**
     * [__construct description]
     *
     * @param HttpRequestByVpsProxy $http_request [description]
     */
    public function __construct(HttpRequestByVpsProxy $http_request)
    {
        $this->http_request = $http_request;
    }

    /**
     * Fetches a html.
     *
     * @param  string $key The song identifier
     * @return <type> The html.
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
     * @param  string $key The song identifier
     * @return <type> The html.
     */
    private function fetchSkymusic(string $skyKey)
    {
        $url_format = 'http://api.skysoundtrack.vn/song/detail?token=eyJhbGciOiJIUzI1NiJ9.eyJ1aWQiOiIyNjcxIiwibmJmIjoxNTczMjA3Mzc3LCJleHAiOjE2MDQ3NDMzNzcsImlhdCI6MTU3MzIwNzM3NywiZGlkIjoiU0tZTVVTSUNBOTFFN0JGQUVGQjY3M0M3MkVGMzJFQTUiLCJqdGkiOiIyMDU2YzNjODdhMzI0ODE5ODRlYTlkNmMyYWI1YjE4NiJ9.R6rxBV-tzOSkpUusPo38VCqOYFiT2SkOJhboMqcx-fA&client_id=9&timestamp=1573442753256&checksum=4039f084bd8637e2f750d906b0670af4e50524fe04633b89ab40a44c440afd1e&skyKey=%s';
        $url        = sprintf($url_format, $skyKey);

        return $this->http_request->get($url);
    }

    /**
     * Fetches a html.
     *
     * @param  string $song_id The song identifier
     * @return <type> The html.
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
     * @param  string $key The key
     * @return <type> The json.
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
     * @param  string $song_id The song identifier
     * @return <type> ( description_of_the_return_value )
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
            Log::error($e);
        }
        
        return false;
    }

    /**
     * { function_description }
     *
     * @param  string $key The key
     * @return <type> ( description_of_the_return_value )
     */
    public function crawlLinkPlay(string $key)
    {
        try {
            $response = $this->fetchJson($key);
            $json     = json_decode($response);

            return $json->data->location;
        } catch (Throwable $e) {
            Log::error($e);
        }

        return false;
    }

    /**
     * Gets the link iframe.
     *
     * @param string $key The key
     */
    public function getLinkIframe(string $key)
    {
        $xml_string = $this->fetchIframe($key);
        $regex      = '#<location>\W+?<!\[CDATA\[(.+?)\]\]>\W+?</location>#';
        if (preg_match($regex, $xml_string, $matches)) {
            return $matches[1];
        }
    }

    /**
     * Gets the link skymusic.
     *
     * @param  string  $skyKey The sky key
     * @return boolean The link skymusic.
     */
    public function getLinkSkymusic(string $skyKey)
    {
        try {
            $json_string = $this->fetchSkymusic($skyKey);
            $song_object = json_decode($json_string);

            if ($this->isSongObjectValid($song_object)) {
                return $song_object->data[0]->streamUrl;
            }
        } catch (Throwable $e) {
            Log::error(
                'CRAWL_LINK_STREAM_SKY_MUSIC_BY_ERROR',
                [
                    'skyKey'   => $skyKey,
                    'response' => $song_object,
                ]
            );

        }
        
        return false;
    }

    /**
     * Determines whether the specified object is song object valid.
     *
     * @param  stdClass $obj The object
     * @return boolean  True if the specified object is song object valid, False otherwise.
     */
    private function isSongObjectValid(stdClass $obj)
    {
        return 'ok' === $obj->status && 1 == $obj->totalRecords;
    }
}

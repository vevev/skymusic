<?php

namespace App\Acme\Services\Fetchs;

use Throwable;
use App\Acme\Services\HttpRequest\HttpRequest;

class FetchJsonListen
{
    private $httpRequest;
    /**
     * Constructor
     *
     * @param HttpRequest $httpRequest [description]
     */
    public function __construct(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    public function execute(array $real_ids, array $playlist_ids)
    {
        try {
            $url_format = 'https://www.nhaccuatui.com/interaction/api/counter?listSongIds=%s&listPlaylistIds=%s';
            $url        = sprintf($url_format, implode(',', $real_ids), implode(',', $playlist_ids));
            $json       = $this->httpRequest->get($url);
            dd($url, $json);

            return json_decode($json)->data;
        } catch (Throwable $e) {
            return;
        }
    }
}

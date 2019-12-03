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

    public function execute(array $real_ids)
    {
        try {
            $url_format = 'https://www.nhaccuatui.com/interaction/api/counter?listSongIds=%s';
            $url        = sprintf($url_format, implode(',', $real_ids));
            $json       = $this->httpRequest->get($url);

            return json_decode($json)->data->songs;
        } catch (Throwable $e) {
            return;
        }
    }
}

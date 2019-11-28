<?php

namespace App\Acme\Services\Fetchs;

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
            $json       = $this->httpRequest->getMobile($url);
            $json       = json_decode($json);
            $result     = trim($json->data);

            return $result;
        } catch (Throwable $e) {
            return;
        }
    }
}

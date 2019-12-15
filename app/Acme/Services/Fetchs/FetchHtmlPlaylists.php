<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class FetchHtmlPlaylists
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

    public function execute(int $page = 1)
    {
        $url_format = 'https://www.nhaccuatui.com/ajax/genre?page=%d&type=playlist';
        $url        = sprintf($url_format, $page);
        $html       = $this->httpRequest->getMobile($url);
        $json       = json_decode($html);
        $result     = trim($json->data);

        return $result ? $result : 1;
    }
}

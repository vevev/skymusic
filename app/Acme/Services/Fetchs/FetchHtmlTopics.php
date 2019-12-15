<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class FetchHtmlTopics
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

    public function execute(int $id, int $page = 1)
    {
        $url_format = 'https://www.nhaccuatui.com/ajax/get-topic-detail-playlist?id=%d&page=%d';
        $url        = sprintf($url_format, $id, $page);
        $html       = $this->httpRequest->get($url);
        $json       = json_decode($html);
        $result     = trim($json->data->content);

        return $result ? $result : false;
    }
}

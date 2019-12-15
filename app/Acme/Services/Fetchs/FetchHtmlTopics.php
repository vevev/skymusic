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

    public function execute(string $slug, int $page = 1)
    {
        $url_format = 'https://www.nhaccuatui.com/playlist/%s.%d.html';
        $url        = sprintf($url_format, $slug, $page);
        $html       = $this->httpRequest->get($url);

        return $html;
    }
}

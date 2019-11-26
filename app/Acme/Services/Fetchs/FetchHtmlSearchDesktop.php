<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class FetchHtmlSearchDesktop
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

    /**
     * [execute description]
     *
     * @param  string      $query          [description]
     * @param  int|integer $page           [description]
     * @return [type]      [description]
     */
    public function execute(string $query, int $page = 1)
    {
        try {
            $url_format = 'https://www.nhaccuatui.com/tim-kiem/bai-hat?q=%s&page=%d';
            $url        = sprintf($url_format, $query, $page < 1 ? 1 : $page);
            $html       = $this->httpRequest->get($url);

            return $html;
        } catch (Throwable $e) {
            return;
        }
    }
}

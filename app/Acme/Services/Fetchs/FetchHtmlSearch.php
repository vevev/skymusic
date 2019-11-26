<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class FetchHtmlSearch
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
            $url_format = 'https://www.nhaccuatui.com/ajax/search-all?q=%s&page=%d&s__type=bai-hat';
            $url        = sprintf($url_format, urlencode($query), $page < 1 ? 1 : $page);
            $html       = $this->httpRequest->getMobile($url);
            $json       = json_decode($html);
            $result     = trim($json->data);

            return $result;
        } catch (Throwable $e) {
            return;
        }
    }
}

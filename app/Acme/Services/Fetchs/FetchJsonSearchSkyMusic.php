<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class FetchJsonSearchSkyMusic
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
            $url_format = 'http://api.skysoundtrack.vn/song/search?token=eyJhbGciOiJIUzI1NiJ9.eyJ1aWQiOiIyNjcxIiwibmJmIjoxNTczMjA3Mzc3LCJleHAiOjE2MDQ3NDMzNzcsImlhdCI6MTU3MzIwNzM3NywiZGlkIjoiU0tZTVVTSUNBOTFFN0JGQUVGQjY3M0M3MkVGMzJFQTUiLCJqdGkiOiIyMDU2YzNjODdhMzI0ODE5ODRlYTlkNmMyYWI1YjE4NiJ9.R6rxBV-tzOSkpUusPo38VCqOYFiT2SkOJhboMqcx-fA&client_id=9&timestamp=1573442753256&checksum=4039f084bd8637e2f750d906b0670af4e50524fe04633b89ab40a44c440afd1e&title=%s';
            $url        = sprintf($url_format, urlencode($query), $page < 1 ? 1 : $page);
            $jsonString = $this->httpRequest->get($url);
            $json       = json_decode($jsonString);

            return $json->data ?? $json->error;
        } catch (Throwable $e) {
            return;
        }
    }
}

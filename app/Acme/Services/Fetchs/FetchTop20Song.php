<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class FetchTop20Song
{
    private $httpRequest;

    private $countries = [
        'vn' => 'nhac-viet',
        'us' => 'au-my',
        'kr' => 'nhac-han',
    ];

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
    public function execute(string $country = 'vn', string $type = 'bai-hat')
    {
        try {
            if ( ! isset($this->countries[$country])) {
                return null;
            }

            $url_format = 'https://www.nhaccuatui.com/%s/top-20.%s.html';
            $url        = sprintf($url_format, $type, $this->countries[$country]);

            return $this->httpRequest->get($url);
        } catch (Throwable $e) {
            return;
        }
    }
}

<?php

namespace App\Acme\Services\Fetchs;

use App\Acme\Services\HttpRequest\HttpRequest;

class FetchTop100Song
{
    private $httpRequest;

    private $categories = [
        'nhac-tre'   => 'm3liaiy6vVsF',
        'tru-tinh'   => 'RKuTtHiGC8US',
        'nhac-trinh' => 'v0AGjIhhCegh',
        'tien-chien' => 'TDSMAL1lI8F6',
        'rap-viet'   => 'iY1AnIsXedqE',
        'remix-viet' => 'aY3KIEnpCywU',
    ];

    /**
     * Constructor
     *
     * @param      HttpRequest  $httpRequest  [description]
     */
    public function __construct(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    /**
     * [execute description]
     *
     * @param      string  $category     The category
     * @param      string  $category_id  The category identifier
     * @param      string       $query  [description]
     * @param      int|integer  $page   [description]
     *
     * @return     [type]  [description]
     */
    public function execute(string $category = 'nhac-tre', string $category_id = 'm3liaiy6vVsF')
    {
        try {
            if ( ! isset($this->categories[$category])) {
                return null;
            }

            $url_format = 'https://www.nhaccuatui.com/top100/top-100-%s.%s.html';
            $url        = sprintf($url_format, $category, $this->categories[$category]);

            return $this->httpRequest->get($url);
        } catch (Throwable $e) {
            return;
        }
    }
}

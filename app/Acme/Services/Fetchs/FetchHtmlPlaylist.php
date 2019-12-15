<?php

namespace App\Acme\Services\Fetchs;

use App\Models\NCTPlaylist;
use App\Acme\Services\HttpRequest\HttpRequest;

class FetchHtmlPlaylist
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

    public function execute(NCTPlaylist $playlist)
    {
        $url_format = 'https://www.nhaccuatui.com/playlist/%s.%s.html';
        $url        = sprintf($url_format, $playlist->slug, $playlist->playlist_id);

        return $this->httpRequest->getMobile($url);
    }
}

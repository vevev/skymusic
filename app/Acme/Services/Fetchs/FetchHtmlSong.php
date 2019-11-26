<?php

namespace App\Acme\Services\Fetchs;

use App\Models\NCTSong;
use App\Acme\Services\HttpRequest\HttpRequest;

class FetchHtmlSong
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

    public function execute(NCTSong $song)
    {
        $url_format = 'https://www.nhaccuatui.com/bai-hat/%s.%s.html';
        $url        = sprintf($url_format, $song->slug, $song->song_id);

        return $this->httpRequest->getMobile($url);
    }
}

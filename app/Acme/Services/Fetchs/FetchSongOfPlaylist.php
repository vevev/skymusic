<?php

namespace App\Acme\Services\Fetchs;

use App\Models\NCTPlaylist;
use Illuminate\Support\Facades\Log;
use App\Acme\Services\HttpRequest\HttpRequest;

class FetchSongOfPlaylist
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
        try {
            $url_format  = 'https://www.nhaccuatui.com/ajax/get-media-info?key2=%s';
            $url         = sprintf($url_format, $playlist->key);
            $json_string = $this->httpRequest->getMobile($url);

            return json_decode($json_string)->data->listItem;
        } catch (Throwable $e) {
            Log::error($e->getMessage());
        }
    }
}

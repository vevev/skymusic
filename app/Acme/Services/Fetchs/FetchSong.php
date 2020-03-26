<?php

namespace App\Acme\Services\Fetchs;

use App\Models\NCTSong;
use App\Acme\Services\Fetchs\FetchHtmlSong;
use App\Acme\Services\HttpRequest\HttpRequest;
use App\Acme\Services\Extracts\ExtractSongHtml;

class FetchSong
{
    private $fetchHtmlSong;
    private $extractSongHtml;
    /**
     * Constructor
     *
     * @param      \App\Acme\Services\Fetchs\FetchHtmlSong      $fetchHtmlSong    The fetch html song
     * @param      \App\Acme\Services\Extracts\ExtractSongHtml  $extractSongHtml  The extract song html
     * @param      HttpRequest  $httpRequest  [description]
     */
    public function __construct(FetchHtmlSong $fetchHtmlSong, ExtractSongHtml $extractSongHtml)
    {
        $this->fetchHtmlSong   = $fetchHtmlSong;
        $this->extractSongHtml = $extractSongHtml;
    }

    /**
     * { function_description }
     *
     * @param      \App\Models\NCTSong  $song   The song
     *
     * @return     <type>               ( description_of_the_return_value )
     */
    public function execute(NCTSong $song)
    {
        $html = $this->fetchHtmlSong->execute($song);

        return $this->extractSongHtml->execute($html);
    }
}

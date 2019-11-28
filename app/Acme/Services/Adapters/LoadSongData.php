<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Acme\Services\Interacts\GetSong;
use App\Exceptions\SongNotFoundException;
use App\Exceptions\CrawlSongFailException;
use App\Acme\Services\Fetchs\FetchHtmlSong;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\HttpRequest\HttpRequest;
use App\Acme\Services\Extracts\ExtractSongHtml;
use App\Acme\Services\Interacts\CreateRelations;

class LoadSongData
{
    private $httpRequest;
    private $nctSongModel;
    private $fetchHtmlSong;
    private $getSong;
    private $extractSongHtml;
    private $createSongs;
    private $createRelations;

    public function __construct(HttpRequest $httpRequest, NCTSong $nctSongModel, FetchHtmlSong $fetchHtmlSong, GetSong $getSong, ExtractSongHtml $extractSongHtml, CreateSongs $createSongs, CreateRelations $createRelations)
    {
        $this->httpRequest     = $httpRequest;
        $this->nctSongModel    = $nctSongModel;
        $this->fetchHtmlSong   = $fetchHtmlSong;
        $this->getSong         = $getSong;
        $this->extractSongHtml = $extractSongHtml;
        $this->createSongs     = $createSongs;
        $this->createRelations = $createRelations;
    }

    public function execute(string $id)
    {
        $song = $this->getSong->execute($id);
        if ( ! $song) {
            throw new SongNotFoundException;
        }

        if ($song->relates->count()) {
            return $song->load('sky');
        }

        $html = $this->fetchHtmlSong->execute($song);

        $data = $this->extractSongHtml->execute($html);
        if ( ! is_array($data)) {
            throw new CrawlSongFailException;
        }

        list($_song, $_songs) = $data;
        if ( ! $song->fill($_song)->save()) {
            throw new UpdateSongFailException;
        }

        if ( ! $this->createSongs->execute($_songs)) {
            throw new SetRelatesFailException;
        }

        if ( ! $this->createRelations->execute($song, $_songs)) {
            throw new CreateRelationFailException;
        }

        $song->load(['relates', 'sky']);

        return $song;
    }
}

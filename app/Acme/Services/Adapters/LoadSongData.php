<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Interacts\GetSong;
use App\Exceptions\SongNotFoundException;
use App\Exceptions\CrawlSongFailException;
use App\Acme\Services\Fetchs\FetchHtmlSong;
use App\Acme\Services\Interacts\CreateSongs;
use App\Acme\Services\Extracts\ExtractSongHtml;
use App\Acme\Services\Interacts\CreateRelations;

class LoadSongData
{
    private $fetchHtmlSong;
    private $getSong;
    private $extractSongHtml;
    private $createSongs;
    private $createRelations;

    public function __construct(FetchHtmlSong $fetchHtmlSong, GetSong $getSong, ExtractSongHtml $extractSongHtml, CreateSongs $createSongs, CreateRelations $createRelations)
    {
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
        } else {
            $song->load('relates.listens');
        }

        if ($song->key && $song->relates->count()) {
            return $song->load(['sky', 'listens']);
        }

        $html = $this->fetchHtmlSong->execute($song);

        $data = $this->extractSongHtml->execute($html);
        if ( ! is_array($data)) {
            throw new CrawlSongFailException;
        }

        [$_song, $_songs] = $data;
        if ( ! $song->fill($_song)->save()) {
            throw new UpdateSongFailException;
        }

        if ( ! $this->createSongs->execute($_songs)) {
            throw new SetRelatesFailException;
        }

        if ( ! $this->createRelations->execute($song, $_songs)) {
            throw new CreateRelationFailException;
        }

        return $song->load(['relates', 'sky', 'listens']);
    }
}

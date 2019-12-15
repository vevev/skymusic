<?php

namespace App\Acme\Services\Extracts;

use Illuminate\Support\Str;

class ExtractDataSearchSkymusic
{
    /**
     * [__construct description]
     */
    public function __construct() {}

    public function execute(array $songs)
    {
        $keys = [];
        foreach ($songs as $index => $song) {
            if ($song->key) {
                $song->slug        = Str::slug($song->title);
                $songs[$song->key] = (array) $song;
                // $songs[$song->key] = [
                //     'key'          => $song->key,
                //     'title'        => $song->title,
                //     'slug'         => $song->slug,
                //     'artists'      => $song->artists,
                //     'duration'     => $song->duration,
                //     'kbit'         => $song->kbit,
                //     'dateModifire' => $song->dateModifire,
                //     'streamUrl'    => $song->streamUrl,
                //     'skyKey'       => $song->skyKey,
                //     'songType'     => $song->songType,
                //     'relatedRight' => $song->relatedRight,
                //     'copyRight'    => $song->copyRight,
                // ];
                $keys[] = $song->key;
            }
            unset($songs[$index]);
        }

        return [$keys, $songs];
    }
}

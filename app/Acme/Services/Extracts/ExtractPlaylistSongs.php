<?php

namespace App\Acme\Services\Extracts;

class ExtractPlaylistSongs
{

    // {
    //     "creator":"<a lp=\"true\" type=\"artist-detail\" key=\"_camila-cabello\" href=\"https://www.nhaccuatui.com/nghe-si-camila-cabello.html\" title=\"Tìm các bài hát, playlist, mv do ca sĩ Camila Cabello trình bày\" >Camila Cabello</a>",
    //     "image":"http://stc.nct.nixcdn.com/static_v8/images/logo-player.jpg",
    //     "thumb":"https://avatar-nct.nixcdn.com/song/2019/09/05/2/6/c/4/1567695634623.jpg",
    //     "bgimage":"http://stc.nct.nixcdn.com/static_v8/images/logo-player.jpg",
    //     "newtab":"https://www.nhaccuatui.com/nghe-si-camila-cabello.bai-hat.html",
    //     "hasHQ":"",
    //     "locationHQ":"",
    //     "singerTitle":"Camila Cabello",
    //     "isPlay":true,
    //     "isAdd":true,
    //     "isSeek":true,
    //     "isDisabled":false,
    //     "avatar":"https://avatar-nct.nixcdn.com/singer/avatar/2017/08/11/1/3/8/b/1502420202194.jpg",
    //     "time":"03:39",
    //     "info":"https://www.nhaccuatui.com/bai-hat/shameless-camila-cabello.2vvrByggsO69.html",
    //     "title":"Shameless",
    //     "songKey":"2vvrByggsO69",
    //     "lyric":"https://lrc-nct.nixcdn.com/2019/09/27/1/b/a/c/1569529691303.lrc",
    //     "kbit":"320",
    //     "key":"6063062",
    //     "location":"https://aredir.nixcdn.com/Sony_Audio66/Shameless-CamilaCabello-6113003.mp3?st=FgzF4JY6srLNxHTcjNdkCQ&e=1576119135";
    // }
    public function execute(array $songs)
    {
        $streamUrls = [];
        $songs      = array_map(function ($song) use (&$streamUrls) {
            if (preg_match('#/([^/]+?)\.[^\.]{5,15}\.html#', $song->info, $match)) {
                $streamUrls[$song->songKey] = $song->location;

                return [
                    'slug'      => $match[1],
                    'real_id'   => $song->key,
                    'thumbnail' => $song->thumb,
                    'song_id'   => $song->songKey,
                    'name'      => $song->title,
                    'key'       => null,
                    'single'    => $song->singerTitle,
                ];
            }
        }, $songs);

        return [array_filter($songs, function ($song) {return $song;}), $streamUrls];
    }
}

<?php

namespace App\Acme\Helpers;

class Helper
{
    public static function formatSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $power = $size > 0 ? floor(log((Int) $size, 1024)) : 0;

        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    public static function parseTitle($title)
    {
        $title = preg_replace('#video#i', 'mp3', $title);
        $title = preg_replace('#\[([^\[\]]*)\]#i', 'mp3', $title);
        $title = preg_replace('#\(.*\)#i', '', $title);
        $title = preg_replace('#Official\s*Music\s*mp3|Official\s*mp3|Official\s*Lyric\s*mp3|Official\s*mp3\s*Clip|MV\s*Official|Official\s*MV|Official\s*Audio|Lyrics|\#music#i', '', $title);
        $title = preg_replace('#\W+?karaoke\W+?#i', '', $title);
        $title = preg_replace('#\W+?HD\W+?|full hd#i', '', $title);
        $title = preg_replace('#\W+$#i', '', $title);
        $title = self::cleanMp3($title);

        return $title;
    }

    public static function duration($isoTime)
    {
        $time = new \DateInterval($isoTime);

        return $time->i * 60 + $time->s + $time->h * 3600 + $time->d * 86400;
    }

    public static function cleanMp3($title)
    {
        return preg_replace(
            ['#^\s*lagu\s*(.+)#i', '#\s*(.+)mp3\s*$#i'],
            ['$1', '$1'],
            $title
        );
    }
}

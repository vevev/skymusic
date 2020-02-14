<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Interacts\GetAllSong;

class LoadMusicData
{
    private $getAllSong;

    public function __construct(GetAllSong $getAllSong)
    {
        $this->getAllSong = $getAllSong;
    }

    public function execute(int $page, int $limit)
    {
        $data = $this->getAllSong->execute($page, $limit);

        return $this->getAllSong->execute($page, $limit);
    }
}

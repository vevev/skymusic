<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Adapters\LoadTop20Song;

class LoadIndexData
{
    private $loadTop20Song;

    public function __construct(LoadTop20Song $loadTop20Song)
    {
        $this->loadTop20Song = $loadTop20Song;
    }

    public function execute()
    {
        $main = $this->loadTop20Song->execute('vn', 'bai-hat');

        return [
            'main'    => $main,
            'sidebar' => [
                'primary'   => $this->loadTop20Song->execute('us', 'bai-hat'),
                'secondary' => $this->loadTop20Song->execute('kr', 'bai-hat'),
                // 'playlist' => $this->loadPlaylistData->execute('')
            ],
        ];
    }
}

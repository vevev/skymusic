<?php

namespace App\Acme\Services\Adapters;

use App\Acme\Services\Adapters\SkymusicLoadSearchData;

class MergeSkyMusic
{
    private $skymusicLoadSearchData;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(SkymusicLoadSearchData $skymusicLoadSearchData)
    {

        $this->skymusicLoadSearchData = $skymusicLoadSearchData;
    }

    public function execute(string $query, array $songs)
    {
        // $skySongs = $this->skymusicLoadSearchData->execute($query);
        // if (!$skySongs['results']) {
        //     return $songs;
        // }

        //     foreach ($songs as $song) {
        //         if($skySongs[$song['song']])
        //     }

        // dd($songs);
    }
}

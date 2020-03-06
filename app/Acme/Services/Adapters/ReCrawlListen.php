<?php

namespace App\Acme\Services\Adapters;

use App\Models\NCTSong;
use App\Models\NCTListen;
use App\Acme\Services\Fetchs\FetchJsonListen;

class ReCrawlListen
{
    private $songModel;
    private $fetchJsonListen;
    private $listenModel;
    private $signed;
    const LIMIT_STATE_PATH = '/home/recrawl-limit';
    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(NCTSong $songModel, FetchJsonListen $fetchJsonListen, NCTListen $listenModel)
    {
        $this->songModel       = $songModel;
        $this->fetchJsonListen = $fetchJsonListen;
        $this->listenModel     = $listenModel;

        $this->signed = date('dmY');
    }

    public function execute()
    {

        echo $this->getLimit();
        echo $this->setLimit(1111);
        echo $this->getLimit();
        // $arrayRealIds = $this->songModel
        //                      ->getSongWithListenIsNull(50, ['nct_songs.real_id'])
        //                      ->pluck('real_id')
        //                      ->toArray();
        // $arrayListen = $this->fetchJsonListen->execute($arrayRealIds);

        // if ( ! $arrayListen) {
        //     return;
        // }

        // $insert = [];
        // foreach ($arrayListen as $id => $listen) {
        //     $insert[] = ['real_id' => $id, 'listen' => $listen, 'type' => 'song'];
        // }

        // $fakeListen = -(date('dmY'));
        // foreach ($arrayRealIds as $id) {
        //     if ( ! isset($arrayListen->{$id})) {
        //         $insert[] = ['real_id' => $id, 'listen' => $fakeListen, 'type' => 'song'];
        //     }
        // }

        // $this->listenModel->insert($insert);
    }

    /**
     * Gets the limit.
     *
     * @return     <type>  The limit.
     */
    private function getLimit()
    {
        $command = sprintf('grep -oP "%d (\d+)" < %s | awk "{print $2}"', $this->signed, self::LIMIT_STATE_PATH);

        return shell_exec($command);
    }

    /**
     * Sets the limit.
     *
     * @param      integer  $limit  The limit
     */
    private function setLimit(int $limit)
    {
        // Kiem tra xem neu nhu chua co
        $command = sprintf('grep -oP "%s" < %s | awk "{print $1}"', $this->signed, self::LIMIT_STATE_PATH);
        if (shell_exec($command) == '') {
            // thi them vao
            $command = sprintf('echo "%s %d" > %s', $this->signed, $limit, self::LIMIT_STATE_PATH);
            shell_exec($command);
        } else {
            // nguoc lai thi thay the
            $command = sprintf('sed -r "s/%s\s[0-9]+/%s %d/" %s', $this->signed, $this->signed, 0, self::LIMIT_STATE_PATH);
            shell_exec($command);
        }
    }
}

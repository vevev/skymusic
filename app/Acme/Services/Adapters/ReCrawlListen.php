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
    const LIMIT_STATE_PATH = '/home/nginx/recrawl-offset';
    const LIMIT            = 100;
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
        $offset = $this->getOffset();

        // neu offset hon hon 0 thi ngung lai
        if ($offset + 0 < 0) {
            return;
        }

        $arrayRealIds = $this->listenModel
                             ->where('type', 'song')
                             ->offset($offset)
                             ->limit(self::LIMIT)
                             ->orderBy('real_id')
                             ->select(['real_id'])
                             ->pluck('real_id')
                             ->toArray();

        $arrayListen = $this->fetchJsonListen->execute($arrayRealIds);

        if ( ! $arrayListen) {
            return;
        }

        $inserts = [];
        $ids     = [];
        foreach ($arrayListen as $id => $listen) {
            $ids[]     = $id;
            $inserts[] = ['real_id' => $id, 'listen' => $listen, 'type' => 'song'];
        }

        // xoa cac bai hat theo id
        $this->listenModel->whereIn('real_id', $ids)->delete();

        // insert cac bai theo id;
        $this->listenModel->insert($inserts);

        if (count($arrayRealIds) == self::LIMIT) {
            $this->setOffset($offset + self::LIMIT);
        } else {
            // Neu offset khong bawng so luong row thi tuc la da het, vay nen set offset
            // thanh so nho hon 0
            $this->setOffset(-($offset + self::LIMIT));
        }
    }

    /**
     * Gets the offset.
     *
     * @return     <type>  The offset.
     */
    private function getOffset()
    {
        $command = sprintf('grep -oP "%d \K-?\d+" < %s', $this->signed, self::LIMIT_STATE_PATH);

        if ($offset = shell_exec($command)) {
            return trim($offset);
        }

        $command = sprintf('echo "%s %d" > %s', $this->signed, $offset, self::LIMIT_STATE_PATH);
        shell_exec($command);

        return 0;
    }

    /**
     * Sets the offset.
     *
     * @param      integer  $offset  The offset
     */
    private function setOffset(int $offset)
    {
        // Kiem tra xem neu nhu chua co
        $command = sprintf('grep -oP "%s" < %s', $this->signed, self::LIMIT_STATE_PATH);
        if (shell_exec($command) == '') {
            // thi them vao
            $command = sprintf('echo "%s %d" > %s', $this->signed, 0, self::LIMIT_STATE_PATH);
        } else {
            // nguoc lai thi thay the
            $command = sprintf('sed -r -i "s/%s\s[0-9]+/%s %s/" %s', $this->signed, $this->signed, $offset, self::LIMIT_STATE_PATH);
            shell_exec($command);
        }
    }
}

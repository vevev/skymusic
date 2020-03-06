<?php

namespace App\Http\Controllers;

use App\Acme\Services\Adapters\CrawlListen;
use App\Acme\Services\Adapters\ReCrawlListen;

class CrawlListenController extends Controller
{
    private $crawlListen;
    private $reCrawlListen;

    /**
     * Constructs a new instance.
     *
     * @param      \App\Acme\Services\Adapters\CrawlListen  $crawlListen  The crawl listen
     */
    public function __construct(CrawlListen $crawlListen, ReCrawlListen $reCrawlListen)
    {
        $this->crawlListen   = $crawlListen;
        $this->reCrawlListen = $reCrawlListen;
    }

    /**
     * { function_description }
     */
    public function index()
    {
        $this->crawlListen->execute();
    }

    /**
     * { function_description }
     */
    public function recrawl()
    {
        $this->reCrawlListen->execute();
    }
}

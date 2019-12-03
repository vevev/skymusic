<?php

namespace App\Http\Controllers;

use App\Acme\Services\Adapters\CrawlListen;

class CrawlListenController extends Controller
{
    private $crawlListen;

    /**
     * Constructs a new instance.
     *
     * @param      \App\Acme\Services\Adapters\CrawlListen  $crawlListen  The crawl listen
     */
    public function __construct(CrawlListen $crawlListen)
    {
        $this->crawlListen = $crawlListen;
    }

    /**
     * { function_description }
     */
    public function index()
    {
        $this->crawlListen->execute();
    }
}

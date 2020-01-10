<?php

namespace App\Http\Controllers;

use App\Models\NCTSong;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    private $songModel;

    const PAGE             = 0;
    const LIMIT_ROW_RESULT = 30000;
    const XML_HEAD         = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '   <urlset' . "\n" .
        '      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n" .
        '      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n" .
        '      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n" .
        '      http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
    const XML_FOOT          = '</urlset>';
    const FILE_TIME_EXPRIES = 3600;
    /**
     * @var string
     */
    private $sitemapPath = '';

    /**
     * @param Request $request
     */
    public function __construct(Request $request, NCTSong $songModel)
    {
        $this->page        = $request->has('page') ? $request->page : self::PAGE;
        $this->limit       = $request->has('limit') ? $request->limit : self::LIMIT_ROW_RESULT;
        $this->sitemapPath = public_path() . '/sitemaps/sitemap-page-' . $this->page;
        $this->songModel   = $songModel;
    }

    /**
     * @param Request $request
     */
    public function run()
    {
        // neu nhu sitemap chua het thoi gian su dung thi lay noi dung sitemap
        // va tra lai cho client
        if ( ! $this->sitemapHasExpried()) {
            return $this->sendSitemapToClient();
        }

        // lay du lieu can them vao sitemap tu database
        $rows = $this->getSitemapData($this->page, $this->limit);

        // khoi tao sitemap
        $this->createSitemap($rows);

        return $this->sendSitemapToClient();
    }

    private function sitemapHasExpried()
    {
        return  ! file_exists($this->sitemapPath) || filemtime($this->sitemapPath) + self::FILE_TIME_EXPRIES < time();
    }

    public function sendSitemapToClient()
    {
        $sitemapContent = file_get_contents($this->sitemapPath);

        return response($sitemapContent)
            ->withHeaders(['Content-Type' => 'text/xml'])
            ->send();
    }

    /**
     * @param  $page
     * @param  $limit
     * @return mixed
     */
    private function getSitemapData($page = 0, $limit = 100)
    {
        return $this->songModel
                    ->offset($this->page * $limit)
                    ->limit($limit)
                    ->get(['name', 'slug', 'song_id']);
    }

    /**
     * @param  $rows
     * @return null
     */
    private function createSitemap($rows)
    {
        // Neu nhu khong co du lieu thi ngung lai
         ! $rows->count() && exit;

        // cache lai cac bien duoc su dung nhieu lan

        $modify = $this->makeModifyTime();

        // write head content
        file_put_contents($this->sitemapPath, self::XML_HEAD);

        foreach ($rows as $row) {
            $url = route('song', ['id' => $row->song_id, 'slug' => $row->slug]);
            file_put_contents($this->sitemapPath, $this->createSitemapRow($url, $modify), FILE_APPEND);
        }

        // them vao link den cac trang tiep theo, muc dich la de cho bot di theo tiep
        // de tiep tuc index cac trang khac nua
        $url = route('sitemap') . '?page=' . ++$this->page;
        file_put_contents($this->sitemapPath, $this->createSitemapRow($url, $modify), FILE_APPEND);

        // write footer
        file_put_contents($this->sitemapPath, self::XML_FOOT, FILE_APPEND);
    }

    /**
     * @param $url
     * @param $modify
     */
    private function createSitemapRow($url, $modify)
    {
        return sprintf("        <url><loc>%s</loc><lastmod>%s</lastmod><changefreq>always</changefreq></url>\n", $url, $modify);
    }

    private function makeModifyTime()
    {
        return date('c', time());
    }
}

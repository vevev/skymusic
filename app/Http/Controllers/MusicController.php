<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use Illuminate\Http\Request;
use App\Acme\Helpers\Pagination;
use App\Acme\Services\Adapters\LoadMusicData;

class MusicController extends Controller
{
    const DEFAULT_PAGE = 1;
    const LIMIT_ROW    = 20;
    private $LoadMusicData;
    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(LoadMusicData $loadMusicData)
    {
        $this->loadMusicData = $loadMusicData;
    }

    public function index(Request $request, Core $core)
    {
        Page::$CANONICAL  = route('index');
        $page             = $request->route('page', self::DEFAULT_PAGE);
        $page < 1 ? $page = 1 : '';
        $data             = $this->loadMusicData->execute($page, self::LIMIT_ROW);
        $data['__core']   = $core;

        $config = [
            'current_page' => $page,           // Trang hiện tại
            'total_record' => $data['rows'],   // Tổng số record
            'limit'        => 20,              // limit
            'link_full'    => '/music/{page}', // Link full có dạng như sau: domain/com/page/{page}
            'link_first'   => '/music',        // Link trang đầu tiên
            'range'        => 6,               // Số button trang bạn muốn hiển thị
        ];

        Pagination::getInstance()->init($config);
        $data['page'] = Pagination::getInstance()->html();

        Page::$title       = 'Tải nhạc hay miễn phí';
        Page::$description = 'Tải nhạc hay miễn phí, tải nhạc chất lượng cao. Miễn phí download về máy. Tải dễ dàng và nhanh chóng.';

        return view(
            Core::viewPath('music'),
            $data
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use App\Acme\Page;
use App\Acme\Services\Adapters\LoadSongData;
use Illuminate\Http\Request;

class SongController extends Controller {
	private $loadSongData;

	public function __construct(LoadSongData $loadSongData, Page $page) {
		$this->loadSongData = $loadSongData;
	}

	public function index(Request $request, Core $core) 
	{
		if( ! $core->isMobile()) {
			return;
		}
		
		if ($request->slug_unverify || $request->id_unverify) {
			return view(Core::viewPath('song-slug'));
		}

		// if ("NyfHSqDdNWs3" == $request->id) {
		// 	Config::set('app.debug', true);
		// }

		$data = $this->loadSongData->execute($request->id);

		if (isset(Page::$geo[1]) && Page::$geo[1] != 'VN' && ! $data['song']->canDownload) {
			return view(Core::viewPath('song-slug'));
		}

		Page::$title = 'Tải Bài Hát ' . $data['song']->name . ' MP3 - Download Miễn Phí';
		Page::$description = $data['song']->name . ' Mp3, tải bài hát ' . $data['song']->name . ' - ' . $data['song']->single . ', tải nhạc chất lượng cao. Miễn phí download về máy. Tải dễ dàng và nhanh chóng ♥';

		// Nếu không có skymusic thì không hiển thị adsense
		if (!$data['song']->hasSkymusic) {
			Page::$IS_ADSENSE = 0;
		}

		// Nếu không có skymusic thì không index
		if (!$data['song']->hasSkymusic && !$data['song']->canDownload) {
			Page::$NO_INDEX = true;
		}
		
		// Page::$NO_INDEX = true;

		return view(
			Core::viewPath('song'),
			array_merge(['__core' => $core], $data)
		);
	}
}

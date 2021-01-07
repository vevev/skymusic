<?php

namespace App\Acme\Services\HttpRequest;

class HttpRequestByVpsProxy {
	private function curl(string $url, array $headers = [], string $cookie = '') {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'user-agent: Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Mobile Safari/537.36',
			'referer: https://www.nhaccuatui.com/',
		));

		return curl_exec($ch);
	}

	public function get(string $url) {
		return $this->curl($url);
		// return $this->curl('method=get&url=' . base64_encode($url));
	}

	public function getFile(string $url) {
		return $this->curl($url);
		// return $this->curl('method=getFile&url=' . base64_encode($url));
	}

	public function getJsonMobile(string $url) {
		return $this->curl($url);
		// return $this->curl('method=getJsonMobile&url=' . base64_encode($url));
	}

	public function getMobile(string $url) {
		return $this->curl($url);
		// return $this->curl('method=getMobile&url=' . base64_encode($url));
	}
}

<?php

namespace App\Acme;

use Illuminate\Http\Request;
use App\Acme\Helpers\MobileDetect;

class Core
{
    public $mobileDetect;
    public $request;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(MobileDetect $mobileDetect, Request $request)
    {
        $this->mobileDetect = $mobileDetect;
        $this->request      = $request;
    }

    public static function viewPath(string $viewName)
    {
        return config('app.template') . '.' . $viewName;
    }

    public function isUcBrowser()
    {
        static $isUc;

        if ( ! is_null($isUc)) {
            return $isUc;
        }

        return $isUc = preg_match('#UC\s*Browser#i', $this->request->header('user-agent'));
    }

    public function accessFromGoogle()
    {
        static $accessFromGoogle;

        if ( ! is_null($accessFromGoogle)) {
            return $accessFromGoogle;
        }

        return $accessFromGoogle = preg_match('#google#i', $this->request->header('referer'));
    }
}

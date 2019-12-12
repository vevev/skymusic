<?php

namespace App\Acme;

use Illuminate\Http\Request;
use Illuminate\Cookie\CookieJar;
use App\Acme\Helpers\MobileDetect;

class Core
{
    public $mobileDetect;
    public $request;

    /**
     * Constructor
     *
     * @param      \App\Acme\Helpers\MobileDetect  $mobileDetect  The mobile detect
     * @param      \Illuminate\Http\Request        $request       The request
     * @param      [type]
     * @return     [type]
     */
    public function __construct(MobileDetect $mobileDetect, Request $request, CookieJar $cookieJar)
    {
        $this->mobileDetect = $mobileDetect;
        $this->request      = $request;

        if ( ! $request->cookie('logo_actived')) {
            $cookieJar->queue(cookie('logo_actived', 1, 86400));
        }
    }

    /**
     * { function_description }
     *
     * @param      string  $viewName  The view name
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public static function viewPath(string $viewName)
    {
        return config('app.template') . '.' . $viewName;
    }

    /**
     * Determines if uc browser.
     *
     * @return     boolean  True if uc browser, False otherwise.
     */
    public function isUcBrowser()
    {
        static $isUc;

        if ( ! is_null($isUc)) {
            return $isUc;
        }

        return $isUc = preg_match('#UC\s*Browser#i', $this->request->header('user-agent'));
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function accessFromGoogle()
    {
        static $accessFromGoogle;

        if ( ! is_null($accessFromGoogle)) {
            return $accessFromGoogle;
        }

        return $accessFromGoogle = preg_match('#google#i', $this->request->header('referer'));
    }
}

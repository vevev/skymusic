<?php
namespace App\Acme;

use GeoIp2\Exception\AddressNotFoundException;

class Page
{
    public static $CANONICAL          = "";
    public static $NO_INDEX           = false;
    public static $IS_MOBILE          = false;
    public static $IS_OPERA           = false;
    public static $IS_UC              = false;
    public static $CLIENT_FROM_GOOGLE = false;
    public static $title              = null;
    public static $description        = null;
    public static $keyword            = null;
    public static $geo;
    public static $IS_ADSENSE = true;
    public static $SEARCH_ADS = false;
    public static $logo       = [
        'src' => null,
        'alt' => null,
    ];
    public static $is_mobile        = false;
    public static $currentRouteName = null;
    public static $showAds          = true;
    const COOKIE_ADS_NAME           = 'AD_MAVEN';
    const COOKIE_ADS_DATA           = true;
    const COOKIE_ADS_EXPRIES        = 3600 * 12;
    /**
     * Constructs a new instance.
     *
     * @return <type> ( description_of_the_return_value )
     */
    public function __construct()
    {

        if ($this->hasAds()) {
            self::$showAds = false;
        } else {
            $this->cookie();
        }
        if (cookie('_ci') && cookie('_co')) {
            return self::$geo = [cookie('_ci'), cookie('_co')];
        }
        try {
            $reader = new Reader('/usr/local/share/GeoIP/GeoLite2-City.mmdb');
            $record = $reader->city($_SERVER['REMOTE_ADDR']);
            setcookie('_co', $record->country->isoCode, time() + 86400 * 30);
            setcookie('_ci', $record->city->name, time() + 86400 * 30);
            $return = [$record->country->isoCode, $record->city->name];
        } catch (AddressNotFoundException $e) {
            return self::$geo = [null, null];
        }
    }

    /**
     * { function_description }
     */
    public function cookie()
    {
        setcookie(self::COOKIE_ADS_NAME, self::COOKIE_ADS_DATA, time() + self::COOKIE_ADS_EXPRIES, '/');
    }

    /**
     * Determines if ads.
     *
     * @return boolean True if ads, False otherwise.
     */
    public function hasAds()
    {
        return isset($_COOKIE[self::COOKIE_ADS_NAME]);
    }

    /**
     * Kiểm tra client đến từ đâu
     *
     * @return mixed
     */
    public function clientFrom($request, $from)
    {
        /**
         * @var array
         */
        static $client = [];
        $hash_key_from = md5($from);
        if (isset($client[$hash_key_from])) {
            return $client[$hash_key_from];
        }
        if (is_array($from)) {
            $from = '#' . implode($from, '|') . '#';
        }

        return $client[$hash_key_from] = preg_match('#' . $from . '#', $request->headers->get('referer'));
    }

    /**
     * Determines if google speed insights.
     *
     * @return boolean True if google speed insights, False otherwise.
     */
    public static function isGoogleSpeedInsights()
    {
        return  ! isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false;
    }
}

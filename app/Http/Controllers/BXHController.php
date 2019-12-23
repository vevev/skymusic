<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadTop20Song;

class BXHController extends Controller
{
    private $loadTop20Song;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(LoadTop20Song $loadTop20Song)
    {
        $this->loadTop20Song = $loadTop20Song;
    }

    /**
     * Index
     *
     * @param      Request  $request
     *
     * @return     View
     */
    public function songVN(Request $request, Core $core)
    {
        $data['songs']  = $this->loadTop20Song->execute('vn', 'bai-hat');
        $data['__core'] = $core;

        return view(Core::viewPath('bxh-song'), $data);
    }

    /**
     * Index
     *
     * @param      Request  $request
     *
     * @return     View
     */
    public function songUS(Request $request, Core $core)
    {
        $data['songs']  = $this->loadTop20Song->execute('us', 'bai-hat');
        $data['__core'] = $core;

        return view(Core::viewPath('bxh-song'), $data);
    }

    /**
     * Index
     *
     * @param      Request  $request
     *
     * @return     View
     */
    public function songKR(Request $request, Core $core)
    {
        $data['songs']  = $this->loadTop20Song->execute('kr', 'bai-hat');
        $data['__core'] = $core;

        return view(Core::viewPath('bxh-song'), $data);
    }

    /**
     * Handle Renew request
     *
     * @param      Request  $request
     *
     * @return     View
     */
    public function renew(string $country, $type)
    {
        return $this->loadTop20Song->execute($country, $type, true);
    }
}

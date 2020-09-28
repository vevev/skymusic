<?php

namespace App\Http\Controllers;

use App\Acme\Core;
use Illuminate\Http\Request;
use App\Acme\Services\Adapters\LoadTop100Song;

class Top100Controller extends Controller
{
    private $loadTop100Song;

    /**
     * Constructor
     *
     * @param      LoadTop100Song  $loadTop100Song  The load top 100 song
     * @param      [type]
     * @return     [type]
     */
    public function __construct(LoadTop100Song $loadTop100Song)
    {
        $this->loadTop100Song = $loadTop100Song;
    }

    /**
     * Index
     *
     * @param      Request  $request
     * @param      Core     $core     The core
     *
     * @return     View
     */
    public function nhactre(Request $request, Core $core)
    {
        $data['songs']  = $this->loadTop100Song->execute('nhac-tre', 'm3liaiy6vVsF') ?? [];
        $data['__core'] = $core;

        return view(Core::viewPath('top-100'), $data);
    }

    /**
     * Handle Renew request
     *
     * @param      string  $category     The category
     * @param      string  $category_id  The category identifier
     * @param      Request  $request
     *
     * @return     View
     */
    public function renew(string $category, string $category_id)
    {
        $this->loadTop100Song->execute($category, $category_id, true);
    }
}

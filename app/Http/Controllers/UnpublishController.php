<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acme\Services\Adapters\SkymusicSaveDatabase;

class UnpublishController extends Controller
{
    private $skymusicSaveDatabase;
    private $request;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(SkymusicSaveDatabase $skymusicSaveDatabase, Request $request)
    {
        $this->skymusicSaveDatabase = $skymusicSaveDatabase;
        $this->request              = $request;
    }

    public function index()
    {
        return $this->skymusicSaveDatabase->execute(1, $this->request->reload ?? false);
    }
}

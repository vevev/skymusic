<?php

namespace App\Http\Controllers;

use App\Acme\Services\Adapters\SkymusicSaveDatabase;

class UnpublishController extends Controller
{
    private $skymusicSaveDatabase;

    /**
     * Constructor
     *
     * @param  [type]
     * @return [type]
     */
    public function __construct(SkymusicSaveDatabase $skymusicSaveDatabase)
    {
        $this->skymusicSaveDatabase = $skymusicSaveDatabase;
    }

    public function index()
    {
        return $this->skymusicSaveDatabase->execute(1);
    }
}

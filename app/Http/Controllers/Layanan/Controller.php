<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('can:manage_layanan');
    }
}

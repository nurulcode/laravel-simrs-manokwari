<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('can:manage_logistik')->except('index');
    }
}

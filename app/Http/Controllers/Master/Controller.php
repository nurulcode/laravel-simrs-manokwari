<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('can:manage_master_data')->except('index');
    }
}

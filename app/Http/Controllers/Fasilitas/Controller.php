<?php

namespace App\Http\Controllers\Fasilitas;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('can:manage_fasilitas')->except('index');
    }
}

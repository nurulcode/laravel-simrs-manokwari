<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('can:manage_kepegawaian')->except('index');
    }
}

<?php

namespace App\Http\Queries\Master;

use Sty\HttpQuery;

class CaraPembayaranQuery extends HttpQuery
{
    public function parent($builder, $value)
    {
        return $builder->where('parent_id', null);
    }
}

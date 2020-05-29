<?php

namespace App\Http\Queries\Fasilitas;

use Sty\HttpQuery;

class KamarQuery extends HttpQuery
{
    public function ruangan($builder, $value)
    {
        return $builder->where('ruangan_id', $value);
    }
}

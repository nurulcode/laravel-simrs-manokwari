<?php

namespace App\Http\Queries\Fasilitas;

use Sty\HttpQuery;

class PoliklinikQuery extends HttpQuery
{
    public function jenis($builder, $value)
    {
        return $builder->where('jenis_id', $value);
    }
}

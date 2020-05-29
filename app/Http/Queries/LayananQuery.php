<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class LayananQuery extends HttpQuery
{
    public function perawatan_type($builder, $value)
    {
        return $builder->where('perawatan_type', $value);
    }

    public function perawatan_id($builder, $value)
    {
        return $builder->where('perawatan_id', $value);
    }
}

<?php

namespace App\Http\Queries\Master;

use Sty\HttpQuery;

class PenyakitQuery extends HttpQuery
{
    public function kelompok($builder, $value)
    {
        return $builder->where('kelompok_id', $value);
    }
}

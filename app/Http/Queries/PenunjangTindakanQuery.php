<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class PenunjangTindakanQuery extends HttpQuery
{
    public function penunjang($builder, $value = '')
    {
        if (!$value) {
            return $builder;
        }

        return $builder->where('penunjang_id', $value);
    }
}

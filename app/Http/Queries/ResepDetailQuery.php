<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class ResepDetailQuery extends HttpQuery
{
    public function perawatan_type($builder, $value)
    {
        return $builder->whereHas('resep', function ($query) use ($value) {
            $query->where('perawatan_type', $value);
        });
    }

    public function perawatan_id($builder, $value)
    {
        return $builder->whereHas('resep', function ($query) use ($value) {
            $query->where('perawatan_id', $value);
        });
    }
}

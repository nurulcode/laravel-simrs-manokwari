<?php

namespace App\Http\Queries\Master;

use Sty\HttpQuery;

class KegiatanQuery extends HttpQuery
{
    public function kategori($builder, $value)
    {
        return $builder->whereHas('kategori', function ($query) use ($value) {
            $query->where('id', $value);
        });
    }
}

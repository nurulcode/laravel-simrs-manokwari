<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class TindakanQuery extends HttpQuery
{
    public function poliklinik($builder, $poliklinik)
    {
        return $builder->whereHas('polikliniks', function ($query) use ($poliklinik) {
            $query->where('id', $poliklinik);
        });
    }
}

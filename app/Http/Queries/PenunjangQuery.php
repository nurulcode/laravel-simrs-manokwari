<?php

namespace App\Http\Queries;

class PenunjangQuery extends LayananQuery
{
    public function jenis($builder, $value = '')
    {
        if (!$value) {
            return $builder;
        }

        return $builder->whereHas('poliklinik', function ($query) use ($value) {
            $query->where('jenis_id', $value);
        });
    }
}

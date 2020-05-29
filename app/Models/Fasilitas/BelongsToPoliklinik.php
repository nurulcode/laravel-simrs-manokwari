<?php

namespace App\Models\Fasilitas;

/**
 * Belongs to Poliklinik
 */
trait BelongsToPoliklinik
{
    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }

    public function searchPoliklinik($builder, $searchQuery)
    {
        return $builder->orwhereHas('poliklinik', function ($query) use ($searchQuery) {
            $query->where('nama', 'like', '%' . $searchQuery . '%')
                ->orWhere('kode', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByPoliklinik($builder, $direction = 'asc')
    {
        $poliklinik = Poliklinik::select('nama')->whereColumn('id', 'poliklinik_id');

        $builder->orderBySub($poliklinik, $direction);

        return $builder;
    }
}

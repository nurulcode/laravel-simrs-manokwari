<?php

namespace App\Models\Master\Wilayah;


/**
 * Belongs to provinsi
 */
trait BelongsToProvinsi
{
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function searchProvinsi($builder, $searchQuery)
    {
        return $builder->orwhereHas('provinsi', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByProvinsi($builder, $direction = 'asc')
    {
        $provinsi_name = Provinsi::select('name')->whereColumn('id', 'provinsi_id');

        $builder->orderBySub($provinsi_name, $direction);

        return $builder;
    }
}

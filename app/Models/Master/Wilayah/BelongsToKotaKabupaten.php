<?php

namespace App\Models\Master\Wilayah;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to kota kabupaten
 */
trait BelongsToKotaKabupaten
{
    use BelongsToProvinsi;

    public static function bootBelongsToKotaKabupaten()
    {
        static::addGlobalScope('provinsi', function (Builder $builder) {
            $builder->addSubSelect('provinsi_id', KotaKabupaten::select('provinsi_id')
                ->whereColumn('id', 'kecamatans.kota_kabupaten_id'));
        });
    }

    public function kota_kabupaten()
    {
        return $this->belongsTo(KotaKabupaten::class);
    }

    public function searchKotaKabupaten($builder, $searchQuery)
    {
        return $builder->orwhereHas('kota_kabupaten', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByKotaKabupaten($builder, $direction = 'asc')
    {
        $kota_kabupaten_name = KotaKabupaten::select('name')
            ->whereColumn('id', 'kota_kabupaten_id');

        $builder->orderBySub($kota_kabupaten_name, $direction);

        return $builder;
    }
}

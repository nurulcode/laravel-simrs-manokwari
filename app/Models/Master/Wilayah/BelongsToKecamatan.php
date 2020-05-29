<?php

namespace App\Models\Master\Wilayah;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to Kecamatan
 */
trait BelongsToKecamatan
{
    use BelongsToKotaKabupaten;

    public static function bootBelongsToKotaKabupaten()
    {
        // Do Nothing
    }

    public static function bootBelongsToKecamatan()
    {
        static::addGlobalScope('ruangan', function (Builder $builder) {
            $kecamatan = Kecamatan::selectRaw('id as kecamatan_id, kota_kabupaten_id');

            $builder->leftJoinSub($kecamatan, 'kecamatan', function ($join) {
                $join->on('kelurahans.kecamatan_id', '=', 'kecamatan.kecamatan_id');
            });
        });
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function searchKecamatan($builder, $searchQuery)
    {
        return $builder->orwhereHas('kecamatan', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByKecamatan($builder, $direction = 'asc')
    {
        $table = $builder->getQuery()->from;

        $kecamatan_name = Kecamatan::withoutGlobalScope('provinsi')
            ->select('name')
            ->whereColumn('id', $table . '.kecamatan_id');

        $builder->orderBySub($kecamatan_name, $direction);

        return $builder;
    }
}

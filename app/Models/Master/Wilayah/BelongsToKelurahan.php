<?php

namespace App\Models\Master\Wilayah;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to Kelurahan
 */
trait BelongsToKelurahan
{
    use BelongsToKecamatan;

    public static function bootBelongsToKecamatan()
    {
        // Do Nothing
    }

    public static function bootBelongsToKelurahan()
    {
        $table = with(new static)->getTable();

        static::addGlobalScope('kelurahan', function (Builder $builder) use ($table) {
            $kelurahan = Kelurahan::selectRaw(
                'id as kelurahan_id, kelurahans.kecamatan_id, kota_kabupaten_id, provinsi_id'
            );

            $builder->leftJoinSub($kelurahan, 'kelurahan', function ($join) use ($table) {
                $join->on($table . '.kelurahan_id', '=', 'kelurahan.kelurahan_id');
            });
        });
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function searchKelurahan($builder, $searchQuery)
    {
        return $builder->orwhereHas('kelurahan', function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        });
    }
}

<?php

namespace App\Models\Fasilitas;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to Ruangan
 */
trait BelongsToRuangan
{
    use BelongsToPoliklinik;

    public static function bootBelongsToRuangan()
    {
        $table = with(new static)->getTable();

        static::addGlobalScope('poliklinik', function (Builder $builder) use ($table) {
            $builder->addSubSelect('poliklinik_id',
                Ruangan::withoutGlobalScopes()
                    ->select('poliklinik_id')
                    ->whereColumn('id', 'kamars.ruangan_id'));
        });

        static::addGlobalScope('kelas', function (Builder $builder) use ($table) {
            $builder->addSubSelect('kelas',
                Ruangan::withoutGlobalScopes()
                    ->select('kelas')
                    ->whereColumn('id', 'kamars.ruangan_id'));
        });
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function searchRuangan($builder, $searchQuery)
    {
        return $builder->orwhereHas('ruangan', function ($query) use ($searchQuery) {
            $query->where('nama', 'like', '%' . $searchQuery . '%')
                ->orWhere('kode', 'like', '%' . $searchQuery . '%');
        });
    }

    public function orderByRuangan($builder, $direction = 'asc')
    {
        $ruangan = Ruangan::withoutGlobalScope('tarif')
            ->select('nama')
            ->whereColumn('id', 'ruangan_id');

        $builder->orderBySub($ruangan, $direction);

        return $builder;
    }
}

<?php

namespace App\Models\Fasilitas;

use App\Models\Model;
use App\Models\Layanan\Kamar;

class Ranjang extends Model
{
    use BelongsToKamar;

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['kode', 'parent'];

    public function afterOrder($builder, $orderBy, $orderDirection)
    {
        switch ($orderBy) {
            case 'poliklinik':
                $builder = $this->orderByRuangan($builder, $orderDirection);
                // no break
            case 'ruangan':
                $builder = $this->orderByKamar($builder, $orderDirection);
                // no break
            case 'kamar':
                $builder = $builder->orderBy('kode', 'asc');
                break;
        }

        return $builder;
    }

    public function searchParent($builder, $searchQuery)
    {
        return $builder->orwhereHas('kamar', function ($query) use ($searchQuery) {
            $query
                ->where('kode', 'like', '%' . $searchQuery . '%')
                ->orWhereExists(function ($query) use ($searchQuery) {
                    $query->select('*')
                        ->from('ruangans')
                        ->whereRaw('ruangans.id = kamars.ruangan_id')
                        ->where(function ($query) use ($searchQuery) {
                            $query
                                ->where('nama', 'like', '%' . $searchQuery . '%')
                                ->orWhere('kode', 'like', '%' . $searchQuery . '%')
                                ->orWhereExists(function ($query) use ($searchQuery) {
                                    $query->select('*')
                                        ->from('polikliniks')
                                        ->whereRaw('ruangans.poliklinik_id = polikliniks.id')
                                        ->where('nama', 'like', '%' . $searchQuery . '%');
                                });
                        });
                });
        });
    }

    public function getRanjangIdAttribute()
    {
        return array_get($this->attributes, 'id');
    }

    public function layanan_kamar()
    {
        return $this->hasOne(Kamar::class)->whereNull('waktu_keluar');
    }

    public function scopeTerisi($query)
    {
        return $query->whereHas('layanan_kamar', function ($query) {
            $query->whereNull('waktu_keluar');
        });
    }

    public function getIsTerisiAttribute()
    {
        return $this->layanan_kamar && is_null($this->layanan_kamar->waktu_keluar);
    }
}

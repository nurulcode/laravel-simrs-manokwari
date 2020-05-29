<?php

namespace App\Models\Fasilitas;

use App\Models\Model;
use App\Models\Tarifable;
use App\Enums\KelasTarif;

class Ruangan extends Model
{
    use BelongsToPoliklinik, Tarifable;

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['nama', 'kode', 'poliklinik'];

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }

    public function getKelasTarifAttribute($value)
    {
        return KelasTarif::getKey((string) $this->kelas);
    }
}

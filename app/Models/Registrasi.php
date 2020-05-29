<?php

namespace App\Models;

use App\Enums\KelasTarif;
use App\Models\Master\JenisRegistrasi;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasTarif;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_registrasi_id',
        'kunjungan_id',
        'perawatan_id',
        'perawatan_type',
    ];

    public function getTarifReference()
    {
        return $this->jenis;
    }

    public function getTarifKelas()
    {
        return KelasTarif::getKey(KelasTarif::TARIF_UMUM);
    }

    public function perawatan()
    {
        return $this->morphTo();
    }

    public function jenis()
    {
        return $this->belongsTo(JenisRegistrasi::class, 'jenis_registrasi_id');
    }

    public function getTotalTarifAttribute()
    {
        return collect($this->tarif)->sum();
    }
}

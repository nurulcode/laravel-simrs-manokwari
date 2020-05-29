<?php

namespace App\Models\Layanan;

use App\Models\Model;
use App\Models\HasTarif;
use App\Enums\KelasTarif;
use App\Models\Kepegawaian\BelongsToPegawai;

class PenunjangTindakan extends Model
{
    use BelongsToPegawai, HasTarif;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_penunjang_tindakans';

    public function penunjang()
    {
        return $this->belongsTo(Penunjang::class);
    }

    public function tindakan()
    {
        return $this->morphTo();
    }

    public function getTarifReference()
    {
        return $this->tindakan;
    }

    public function getTarifKelas()
    {
        return KelasTarif::getKey((string) $this->penunjang->perawatan->kelas);
    }

    public function getUraianAttribute()
    {
        return $this->tindakan->uraian;
    }

    public function getTotalTarifAttribute()
    {
        return collect($this->tarif)->sum() * $this->jumlah;
    }
}

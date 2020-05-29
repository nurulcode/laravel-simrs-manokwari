<?php

namespace App\Models\Layanan;

use App\Models\Model;
use App\Models\Logistik\Logistik;
use App\Models\Kepegawaian\BelongsToPegawai;

class ResepDetail extends Model
{
    use BelongsToPegawai;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resep_id', 'obat_id', 'petugas_id', 'waktu', 'jumlah', 'aturan_pakai'
    ];

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
    protected $table = 'layanan_resep_details';

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }

    public function obat()
    {
        return $this->belongsTo(Logistik::class);
    }
}

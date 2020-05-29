<?php

namespace App\Models\Perawatan;

use App\Models\Model;
use App\Models\HasKunjungan;
use App\Models\Master\Kegiatan;
use Illuminate\Support\Collection;
use App\Models\Layanan\HasLayananDiagnosa;
use App\Models\Layanan\HasLayananTindakan;
use App\Models\Layanan\HasLayananPenunjang;
use App\Models\Fasilitas\BelongsToPoliklinik;
use App\Models\Layanan\Resep;

abstract class Perawatan extends Model
{
    use HasKunjungan,
        HasLayananDiagnosa,
        HasLayananTindakan,
        HasLayananPenunjang,
        BelongsToPoliklinik;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu_masuk'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded;

    protected $tarifable_layanan = [];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function resep()
    {
        return $this->morphOne(Resep::class, 'perawatan');
    }

    public function tarifable_layanan()
    {
        return array_wrap($this->tarifable_layanan);
    }

    public function getTotalBiaya()
    {
        $biaya = collect([]);

        foreach ($this->tarifable_layanan() as $layanan => $layanan_title) {
            $biaya->push(Collection::wrap($this->{$layanan})->sum('total_tarif'));
        }

        foreach ($this->penunjangs as $penunjang) {
            $biaya->push($penunjang->getTotalBiaya());
        }

        return $biaya->sum();
    }
}

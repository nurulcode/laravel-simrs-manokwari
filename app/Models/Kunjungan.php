<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Master\Penyakit\Penyakit;

class Kunjungan extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu_masuk', 'rujukan_tanggal', 'sjp_tanggal'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['rujukan'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['pasien', 'penyakit'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kasus_id', 'pasien_id', 'penyakit_id', 'waktu_masuk', 'waktu_keluar',

        'rujukan', 'jenis_rujukan_id', 'rujukan_asal', 'rujukan_nomor', 'rujukan_tanggal',

        'pj_nama', 'pj_telepon', 'sjp_nomor', 'sjp_tanggal', 'cara_pembayaran_id'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->waktu_masuk)) {
                $model->waktu_masuk = now();
            }
        });

        static::created(function ($model) {
            if (empty($model->nomor_kunjungan)) {
                $model->nomor_kunjungan = str_pad($model->id, 8, 0, STR_PAD_LEFT);
            }

            $model->save();
        });
    }

    public function getRujukanAttribute()
    {
        return [
            'jenis_id' => $this->attributes['jenis_rujukan_id'],
            'asal'     => $this->attributes['rujukan_asal'],
            'nomor'    => $this->attributes['rujukan_nomor'],
            'tanggal'  => $this->attributes['rujukan_tanggal'],
        ];
    }

    public function setRujukanAttribute($value)
    {
        $this->attributes['jenis_rujukan_id'] = $value['jenis_id'];
        $this->attributes['rujukan_asal']     = $value['asal'];
        $this->attributes['rujukan_nomor']    = $value['nomor'];
        $this->attributes['rujukan_tanggal']  = $value['tanggal'];
    }

    public function registrasis()
    {
        return $this->hasMany(Registrasi::class);
    }

    public function rawat_jalans()
    {
        return $this
            ->belongsToMany(
                Perawatan\RawatJalan::class,
                'registrasis',
                'kunjungan_id',
                'perawatan_id'
            )->wherePivot('perawatan_type', Perawatan\RawatJalan::class);
    }

    public function rawat_darurats()
    {
        return $this
            ->registrasis()
            ->where('perawatan_type', Perawatan\RawatDarurat::class);
    }

    public function rawat_inaps()
    {
        return $this
            ->belongsToMany(
                Perawatan\RawatInap::class,
                'registrasis',
                'kunjungan_id',
                'perawatan_id'
            )->wherePivot('perawatan_type', Perawatan\RawatInap::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function scopeHariIni($query)
    {
        return $query->where('waktu_masuk', Carbon::now());
    }

    public function getTotalBiaya()
    {
        $registrasis = $this->registrasis()->whereHas('jenis')->get();

        $perawatans  = $this->registrasis()->whereNotNull('perawatan_id')->get();

        $perawatans  = $perawatans->map->perawatan;

        $biaya       = collect([]);

        foreach ($registrasis as $registrasi) {
            $biaya->push($registrasi->total_tarif);
        }

        foreach ($perawatans as $perawatan) {
            $biaya->push($perawatan->getTotalBiaya());

            if ($perawatan->resep) {
                $biaya->push($perawatan->resep->getTotalBiaya());
            }
        }

        return $biaya->sum();
    }
}

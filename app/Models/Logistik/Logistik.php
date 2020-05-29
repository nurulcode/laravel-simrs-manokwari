<?php

namespace App\Models\Logistik;

use App\Models\Model;
use App\Models\Master\JenisLogistik;

class Logistik extends Model
{
    public function jenis()
    {
        return $this->belongsTo(JenisLogistik::class);
    }

    public function orderByJenis($builder, $direction = 'asc')
    {
        $jenis = JenisLogistik::select('uraian')->whereColumn('id', 'logistiks.jenis_id');

        $builder->orderBySub($jenis, $direction);

        $builder->orderBy('uraian', 'asc');

        return $builder;
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function scopeStock($query, $value = null)
    {
        if (is_null($query->getQuery()->columns)) {
            $query->select($query->getQuery()->from . '.*');
        }

        $transaksi = Transaksi::withoutGlobalScopes()
            ->selectRaw('SUM(jumlah)')
            ->whereColumn('logistiks.id', 'logistik_transaksis.logistik_id');

        if ($value) {
            $transaksi->where('apotek_id', $value);
        }

        return $query->selectSub($transaksi, 'stock');
    }

    public function getStockAttribute()
    {
        return (int) array_get($this->attributes, 'stock', 0);
    }

    public function getStock($apotek = null)
    {
        if ($apotek) {
            return $this->transaksis()->where('apotek_id', $apotek)->sum('jumlah');
        }

        return $this->transaksis()->sum('jumlah');
    }
}

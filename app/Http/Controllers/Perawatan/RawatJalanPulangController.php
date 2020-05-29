<?php

namespace App\Http\Controllers\Perawatan;

use App\Enums\KondisiAkhir;
use Illuminate\Http\Request;
use BenSampo\Enum\Rules\EnumValue;
use App\Http\Controllers\Controller;
use App\Models\Perawatan\RawatJalan;
use App\Http\Resources\Perawatan\RawatJalanResource;

class RawatJalanPulangController extends Controller
{
    public function __invoke(RawatJalan $rawat_jalan, Request $request)
    {
        $request->validate([
            'waktu_keluar'   => ['required', 'date'],
            'kondisi_akhir'  => ['required', new EnumValue(KondisiAkhir::class)],
        ]);

        $rawat_jalan->waktu_keluar  = $request->input('waktu_keluar');
        $rawat_jalan->kondisi_akhir = $request->input('kondisi_akhir');

        $rawat_jalan->save();

        $kunjungan = $rawat_jalan->kunjungan;

        $kunjungan->waktu_keluar = $request->input('waktu_keluar');

        $kunjungan->save();

        return response()->crud(new RawatJalanResource($rawat_jalan));
    }
}

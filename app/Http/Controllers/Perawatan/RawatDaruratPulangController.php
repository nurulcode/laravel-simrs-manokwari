<?php

namespace App\Http\Controllers\Perawatan;

use App\Enums\KondisiAkhir;
use Illuminate\Http\Request;
use BenSampo\Enum\Rules\EnumValue;
use App\Http\Controllers\Controller;
use App\Models\Perawatan\RawatDarurat;
use App\Http\Resources\Perawatan\RawatDaruratResource;

class RawatDaruratPulangController extends Controller
{
    public function __invoke(RawatDarurat $rawat_darurat, Request $request)
    {
        $request->validate([
            'waktu_keluar'   => ['required', 'date'],
            'kondisi_akhir'  => ['required', new EnumValue(KondisiAkhir::class)],
        ]);

        $rawat_darurat->waktu_keluar  = $request->input('waktu_keluar');
        $rawat_darurat->kondisi_akhir = $request->input('kondisi_akhir');

        $rawat_darurat->save();

        $kunjungan = $rawat_darurat->kunjungan;

        $kunjungan->waktu_keluar = $request->input('waktu_keluar');

        $kunjungan->save();

        return response()->crud(new RawatDaruratResource($rawat_darurat));
    }
}

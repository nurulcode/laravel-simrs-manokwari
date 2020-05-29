<?php

namespace App\Http\Controllers\Perawatan;

use Illuminate\Http\Request;
use App\Models\Perawatan\RawatInap;
use App\Http\Controllers\Controller;
use App\Http\Resources\Perawatan\RawatInapResource;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\KeadaanKeluar;
use App\Enums\CaraKeluar;

class RawatInapPulangController extends Controller
{
    public function __invoke(RawatInap $rawat_inap, Request $request)
    {
        $request->validate([
            'waktu_keluar'   => ['required', 'date'],
            'keadaan_keluar' => ['required', new EnumValue(KeadaanKeluar::class)],
            'cara_keluar'    => ['required', new EnumValue(CaraKeluar::class)],
            'rujukan'        => ['nullable'],
            'rs_tujuan'      => ['nullable'],
            'catatan'        => ['nullable'],
        ]);

        $rawat_inap->pulang()->create([
            'waktu_keluar'   => $request->input('waktu_keluar'),
            'keadaan_keluar' => $request->input('keadaan_keluar'),
            'cara_keluar'    => $request->input('cara_keluar'),
        ]);

        return response()->crud(new RawatInapResource($rawat_inap));
    }
}

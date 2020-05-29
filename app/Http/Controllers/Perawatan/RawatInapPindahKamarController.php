<?php

namespace App\Http\Controllers\Perawatan;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Perawatan\RawatInap;
use App\Http\Controllers\Controller;
use App\Http\Resources\Perawatan\RawatInapResource;
use App\Models\Fasilitas\Ranjang;

class RawatInapPindahKamarController extends Controller
{
    public function __invoke(RawatInap $rawat_inap, Request $request)
    {
        $not_in = Rule::notIn(
            Ranjang::select('id')->terisi()->get()->pluck('id')
        );

        $request->validate([
            'waktu_pindah'  => 'required|date',
            'poliklinik_id' => 'required|exists:polikliniks,id',
            'ruangan_id'    => 'required|exists:ruangans,id',
            'kamar_id'      => 'required|exists:kamars,id',
            'ranjang_id'    => ['required', 'exists:ranjangs,id', $not_in]
        ]);

        $kunjungan = $rawat_inap->kunjungan;
        $kamar     = $rawat_inap->layanan_kamar;

        $kamar->waktu_keluar = $request->input('waktu_pindah', now());

        $kamar->save();

        $new_inap = RawatInap::withoutGlobalScopes()
            ->find($rawat_inap->id)
            ->replicate(/** except*/ ['ranjang_id', 'waktu_masuk']);

        $new_inap->waktu_masuk = $request->input('waktu_pindah');

        $new_inap->ranjang_id  = $request->input('ranjang_id');

        $new_inap->save();

        $new_inap->registrasi()->create(['kunjungan_id' => $kunjungan->id]);

        return response()->crud(new RawatInapResource($new_inap));
    }
}

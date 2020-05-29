<?php

namespace App\Http\Controllers\Perawatan;

use Sty\HttpQuery;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Perawatan\RawatJalan;
use App\Http\Resources\Perawatan\RawatJalanResource;
use App\Http\Requests\Perawatan\CreateRawatJalanRequest;

class RawatJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return RawatJalanResource::collection(
            RawatJalan::with(['kunjungan', 'poliklinik'])->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRawatJalanRequest $request)
    {
        $rawat_jalan = RawatJalan::create($request->validated());

        $kunjungan   = Kunjungan::create($request->validated());

        if ($request->input('pasien_baru', false)) {
            $kunjungan->registrasis()->create(['jenis_registrasi_id' => 1]);
        }

        $rawat_jalan->registrasi()->create([
            'kunjungan_id'        => $kunjungan->id,
            'jenis_registrasi_id' => $request->input('jenis_registrasi_id')
        ]);

        return response()->crud(new RawatJalanResource($rawat_jalan));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelayanan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function show(RawatJalan $rawat_jalan)
    {
        return new RawatJalanResource($rawat_jalan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelayanan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawatJalan $rawat_jalan)
    {
        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelayanan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawatJalan $rawat_jalan)
    {
        return abort(403);
    }
}

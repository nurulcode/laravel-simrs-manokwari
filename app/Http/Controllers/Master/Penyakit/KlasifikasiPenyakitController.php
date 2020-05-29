<?php

namespace App\Http\Controllers\Master\Penyakit;

use Sty\HttpQuery;
use App\Http\Controllers\Master\Controller;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;
use App\Http\Requests\Master\Penyakit\KlasifikasiPenyakitRequest;
use App\Http\Resources\Master\Penyakit\KlasifikasiPenyakitResource;

class KlasifikasiPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return KlasifikasiPenyakitResource::collection(
            KlasifikasiPenyakit::filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KlasifikasiPenyakitRequest $request)
    {
        return response()->crud(
            new KlasifikasiPenyakitResource(
                KlasifikasiPenyakit::create($request->validated())
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Penyakit\KlasifikasiPenyakit  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(KlasifikasiPenyakit $klasifikasi)
    {
        return new KlasifikasiPenyakitResource($klasifikasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Penyakit\KlasifikasiPenyakit  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(
        KlasifikasiPenyakitRequest $request,
        KlasifikasiPenyakit $klasifikasi)
    {
        return response()->crud(
            new KlasifikasiPenyakitResource(
                tap($klasifikasi)->update($request->validated())
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Penyakit\KlasifikasiPenyakit  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(KlasifikasiPenyakit $klasifikasi)
    {
        return response()->crud(tap($klasifikasi)->delete());
    }
}

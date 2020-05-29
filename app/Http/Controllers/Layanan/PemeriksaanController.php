<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Queries\LayananQuery;
use App\Models\Layanan\Pemeriksaan;
use App\Http\Requests\Layanan\PemeriksaanRequest;
use App\Http\Resources\Layanan\PemeriksaanResource;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return PemeriksaanResource::collection(
            Pemeriksaan::with('pemeriksaan_umum', 'petugas')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PemeriksaanRequest $request)
    {
        return response()->crud(
            new PemeriksaanResource(Pemeriksaan::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
        return new PemeriksaanResource($pemeriksaan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function update(PemeriksaanRequest $request, Pemeriksaan $pemeriksaan)
    {
        return response()->crud(
            new PemeriksaanResource(tap($pemeriksaan)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        return response()->crud(tap($pemeriksaan)->delete());
    }
}

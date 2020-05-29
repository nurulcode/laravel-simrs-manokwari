<?php

namespace App\Http\Controllers\Master\Wilayah;

use App\Models\Master\Wilayah\Kecamatan;
use App\Http\Controllers\Master\Controller;
use App\Http\Requests\Master\Wilayah\KecamatanRequest;
use App\Http\Resources\Master\Wilayah\KecamatanResource;
use App\Http\Queries\Master\WilayahQuery;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WilayahQuery $query)
    {
        return KecamatanResource::collection(
            Kecamatan::with('provinsi', 'kota_kabupaten')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KecamatanRequest $request)
    {
        return response()->crud(
            new KecamatanResource(Kecamatan::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Wilayah\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        return new KecamatanResource($kecamatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Wilayah\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(KecamatanRequest $request, Kecamatan $kecamatan)
    {
        return response()->crud(
            new KecamatanResource(tap($kecamatan)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Wilayah\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        return response()->crud(tap($kecamatan)->delete());
    }
}

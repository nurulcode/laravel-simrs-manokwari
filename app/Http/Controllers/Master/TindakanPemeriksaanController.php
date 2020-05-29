<?php

namespace App\Http\Controllers\Master;

use App\TindakanPoliklinik;
use App\Http\Queries\TindakanQuery;
use App\Models\Master\TindakanPemeriksaan;
use App\Http\Requests\Master\TindakanPemeriksaanRequest;
use App\Http\Resources\Master\TindakanPemeriksaanResource;

class TindakanPemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TindakanQuery $query)
    {
        return TindakanPemeriksaanResource::collection(
            TindakanPemeriksaan::with('polikliniks', 'prosedur')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TindakanPemeriksaanRequest $request)
    {
        return response()->crud(new TindakanPemeriksaanResource(
            TindakanPoliklinik::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\TindakanPemeriksaan  $tindakan_pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function show(TindakanPemeriksaan $tindakan_pemeriksaan)
    {
        return new TindakanPemeriksaanResource($tindakan_pemeriksaan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\TindakanPemeriksaan  $tindakan_pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function update(TindakanPemeriksaanRequest $request, TindakanPemeriksaan $tindakan_pemeriksaan)
    {
        return response()->crud(new TindakanPemeriksaanResource(
            TindakanPoliklinik::update($tindakan_pemeriksaan, $request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\TindakanPemeriksaan  $tindakan_pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TindakanPemeriksaan $tindakan_pemeriksaan)
    {
        return response()->crud(tap($tindakan_pemeriksaan)->delete());
    }
}

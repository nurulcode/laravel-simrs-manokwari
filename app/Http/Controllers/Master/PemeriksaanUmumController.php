<?php

namespace App\Http\Controllers\Master;

use App\Models\Master\PemeriksaanUmum;
use App\Http\Requests\Master\PemeriksaanUmumRequest;
use App\Http\Resources\Master\PemeriksaanUmumResource;
use App\Http\Queries\GroupedQuery;

class PemeriksaanUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupedQuery $query)
    {
        return PemeriksaanUmumResource::collection(
            PemeriksaanUmum::with('parent')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PemeriksaanUmumRequest $request)
    {
        return response()->crud(
            new PemeriksaanUmumResource(
                PemeriksaanUmum::create($request->validated())
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\PemeriksaanUmum  $pemeriksaan_umum
     * @return \Illuminate\Http\Response
     */
    public function show(PemeriksaanUmum $pemeriksaan_umum)
    {
        return new PemeriksaanUmumResource($pemeriksaan_umum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\PemeriksaanUmum  $pemeriksaan_umum
     * @return \Illuminate\Http\Response
     */
    public function update(
        PemeriksaanUmumRequest $request, PemeriksaanUmum $pemeriksaan_umum
    ) {
        return response()->crud(
            new PemeriksaanUmumResource(
                tap($pemeriksaan_umum)->update($request->validated())
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\PemeriksaanUmum  $pemeriksaan_umum
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemeriksaanUmum $pemeriksaan_umum)
    {
        return response()->crud(tap($pemeriksaan_umum)->delete());
    }
}

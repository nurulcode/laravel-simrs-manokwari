<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Penunjang;
use App\Http\Requests\Layanan\PenunjangRequest;
use App\Http\Resources\Layanan\PenunjangResource;
use App\Http\Queries\PenunjangQuery;

class PenunjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PenunjangQuery $query)
    {
        return PenunjangResource::collection(
            Penunjang::with([
                'poliklinik',
                'perawatan.kunjungan',
                'perawatan.poliklinik'
            ])->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenunjangRequest $request)
    {
        return response()->crud(
            new PenunjangResource(Penunjang::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function show(Penunjang $penunjang)
    {
        return new PenunjangResource($penunjang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function update(PenunjangRequest $request, Penunjang $penunjang)
    {
        return response()->crud(
            new PenunjangResource(tap($penunjang)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penunjang $penunjang)
    {
        return response()->crud(tap($penunjang)->delete());
    }
}

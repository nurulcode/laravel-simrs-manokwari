<?php

namespace App\Http\Controllers\Master;

use App\KegiatanKategori;
use App\Models\Master\Kegiatan;
use App\Http\Queries\Master\KegiatanQuery;
use App\Http\Requests\Master\KegiatanRequest;
use App\Http\Resources\Master\KegiatanResource;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KegiatanQuery $query)
    {
        return KegiatanResource::collection(Kegiatan::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KegiatanRequest $request)
    {
        return response()->crud(
            new KegiatanResource(KegiatanKategori::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        return new KegiatanResource($kegiatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(KegiatanRequest $request, Kegiatan $kegiatan)
    {
        return response()->crud(
            new KegiatanResource(KegiatanKategori::update($kegiatan, $request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        return response()->crud(tap($kegiatan)->delete());
    }
}

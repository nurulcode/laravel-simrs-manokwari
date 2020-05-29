<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\KategoriKegiatan;
use App\Http\Resources\Master\KategoriKegiatanResource;

class KategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return KategoriKegiatanResource::collection(KategoriKegiatan::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new KategoriKegiatanResource(
            KategoriKegiatan::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\KategoriKegiatan  $kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriKegiatan $kategori_kegiatan)
    {
        return new KategoriKegiatanResource($kategori_kegiatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\KategoriKegiatan  $kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriKegiatan $kategori_kegiatan)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new KategoriKegiatanResource(
            tap($kategori_kegiatan)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\KategoriKegiatan  $kategori_kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriKegiatan $kategori_kegiatan)
    {
        return response()->crud(tap($kategori_kegiatan)->delete());
    }
}

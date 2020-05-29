<?php

namespace App\Http\Controllers\Kepegawaian;

use Sty\HttpQuery;
use App\Http\Resources\Master\Resource;
use App\Models\Kepegawaian\KategoriKualifikasi;
use App\Http\Requests\Kepegawaian\KategoriKualifikasiRequest;
use App\Http\Resources\Kepegawaian\KategoriKualifikasiResource;

class KategoriKualifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return KategoriKualifikasiResource::collection(
            KategoriKualifikasi::filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriKualifikasiRequest $request)
    {
        return response()->crud(
            new KategoriKualifikasiResource(
                KategoriKualifikasi::create($request->validated())
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kepegawaian\KategoriKualifikasi  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriKualifikasi $kategori)
    {
        return new KategoriKualifikasiResource($kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kepegawaian\KategoriKualifikasi  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriKualifikasiRequest $request, KategoriKualifikasi $kategori)
    {
        return response()->crud(
            new KategoriKualifikasiResource(
                tap($kategori)->update($request->validated())
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kepegawaian\KategoriKualifikasi  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriKualifikasi $kategori)
    {
        return response()->crud(tap($kategori)->delete());
    }
}

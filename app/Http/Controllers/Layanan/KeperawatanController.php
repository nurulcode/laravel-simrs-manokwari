<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Queries\LayananQuery;
use App\Models\Layanan\Keperawatan;
use App\Http\Requests\Layanan\KeperawatanRequest;
use App\Http\Resources\Layanan\KeperawatanResource;

class KeperawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return KeperawatanResource::collection(
            Keperawatan::with('petugas', 'perawatan_khusus')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeperawatanRequest $request)
    {
        return response()->crud(
            new KeperawatanResource(Keperawatan::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Keperawatan  $keperawatan
     * @return \Illuminate\Http\Response
     */
    public function show(Keperawatan $keperawatan)
    {
        return new KeperawatanResource($keperawatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Keperawatan  $keperawatan
     * @return \Illuminate\Http\Response
     */
    public function update(KeperawatanRequest $request, Keperawatan $keperawatan)
    {
        return response()->crud(
            new KeperawatanResource(tap($keperawatan)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Keperawatan  $keperawatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keperawatan $keperawatan)
    {
        return response()->crud(tap($keperawatan)->delete());
    }
}

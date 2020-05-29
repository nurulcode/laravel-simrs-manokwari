<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Kebidanan;
use App\Http\Queries\LayananQuery;
use App\Http\Requests\Layanan\KebidananRequest;
use App\Http\Resources\Layanan\KebidananResource;

class KebidananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return KebidananResource::collection(
            Kebidanan::with('petugas', 'kegiatan')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KebidananRequest $request)
    {
        return response()->crud(
            new KebidananResource(Kebidanan::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Kebidanan  $kebidanan
     * @return \Illuminate\Http\Response
     */
    public function show(Kebidanan $kebidanan)
    {
        return new KebidananResource($kebidanan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Kebidanan  $kebidanan
     * @return \Illuminate\Http\Response
     */
    public function update(KebidananRequest $request, Kebidanan $kebidanan)
    {
        return response()->crud(
            new KebidananResource(tap($kebidanan)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Kebidanan  $kebidanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kebidanan $kebidanan)
    {
        return response()->crud(tap($kebidanan)->delete());
    }
}

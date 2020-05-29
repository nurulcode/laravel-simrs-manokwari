<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Gizi;
use App\Http\Queries\LayananQuery;
use App\Http\Requests\Layanan\GiziRequest;
use App\Http\Resources\Layanan\GiziResource;

class GiziController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return GiziResource::collection(Gizi::with('petugas', 'gizi')->filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GiziRequest $request)
    {
        return response()->crud(
            new GiziResource(Gizi::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Gizi  $gizi
     * @return \Illuminate\Http\Response
     */
    public function show(Gizi $gizi)
    {
        return new GiziResource($gizi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Gizi  $gizi
     * @return \Illuminate\Http\Response
     */
    public function update(GiziRequest $request, Gizi $gizi)
    {
        return response()->crud(
            new GiziResource(tap($gizi)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Gizi  $gizi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gizi $gizi)
    {
        return response()->crud(tap($gizi)->delete());
    }
}

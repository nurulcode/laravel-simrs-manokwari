<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Resep;
use App\Http\Queries\LayananQuery;
use App\Http\Requests\Layanan\ResepRequest;
use App\Http\Resources\Layanan\ResepResource;

class ResepController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_layanan_resep');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return ResepResource::collection(
            Resep::with(
                'perawatan',
                'perawatan.poliklinik',
                'perawatan.kunjungan'
            )->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResepRequest $request)
    {
        return response()->crud(
            new ResepResource(Resep::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show(Resep $resep)
    {
        return new ResepResource($resep);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function update(ResepRequest $request, Resep $resep)
    {
        return response()->crud(
            new ResepResource(tap($resep)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resep $resep)
    {
        return response()->crud(tap($resep)->delete());
    }
}

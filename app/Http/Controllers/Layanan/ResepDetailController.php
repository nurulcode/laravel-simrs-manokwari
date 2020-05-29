<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\ResepDetail;
use App\Http\Requests\Layanan\ResepDetailRequest;
use App\Http\Resources\Layanan\ResepDetailResource;
use App\Http\Resources\Layanan\ResepResource;
use App\Models\Layanan\Resep;
use App\Http\Queries\ResepDetailQuery;

class ResepDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResepDetailQuery $query)
    {
        return ResepDetailResource::collection(
            ResepDetail::with('resep', 'obat', 'petugas')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResepDetailRequest $request)
    {
        $resep  = Resep::firstOrCreate($request->only(['perawatan_id', 'perawatan_type']));

        $detail = new ResepDetail($request->validated());

        $resep->details()->save($detail);

        return response()->crud(new ResepDetailResource($detail));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\ResepDetail  $resep_detail
     * @return \Illuminate\Http\Response
     */
    public function show(ResepDetail $resep_detail)
    {
        return new ResepResource($resep_detail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\ResepDetail  $resep_detail
     * @return \Illuminate\Http\Response
     */
    public function update(ResepDetailRequest $request, ResepDetail $resep_detail)
    {
        return response()->crud(
            new ResepDetailResource(tap($resep_detail)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\ResepDetail  $resep_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResepDetail $resep_detail)
    {
        return response()->crud(tap($resep_detail)->delete());
    }
}

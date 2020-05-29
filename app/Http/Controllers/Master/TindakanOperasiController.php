<?php

namespace App\Http\Controllers\Master;

use App\Http\Queries\GroupedQuery;
use App\Models\Master\TindakanOperasi;
use App\Http\Resources\Master\Resource;
use App\Http\Requests\Master\TindakanOperasiRequest;
use App\Http\Resources\Master\TindakanOperasiResource;

class TindakanOperasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupedQuery $query)
    {
        return TindakanOperasiResource::collection(
            TindakanOperasi::with('parent', 'childs')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TindakanOperasiRequest $request)
    {
        return response()->crud(
            new TindakanOperasiResource(TindakanOperasi::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\TindakanOperasi  $tindakan_operasi
     * @return \Illuminate\Http\Response
     */
    public function show(TindakanOperasi $tindakan_operasi)
    {
        return new TindakanOperasiResource($tindakan_operasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\TindakanOperasi  $tindakan_operasi
     * @return \Illuminate\Http\Response
     */
    public function update(TindakanOperasiRequest $request, TindakanOperasi $tindakan_operasi)
    {
        return response()->crud(
            new TindakanOperasiResource(tap($tindakan_operasi)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\TindakanOperasi  $tindakan_operasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(TindakanOperasi $tindakan_operasi)
    {
        return response()->crud(tap($tindakan_operasi)->delete());
    }
}

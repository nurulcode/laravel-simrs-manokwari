<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan\PenunjangTindakan;
use App\Http\Queries\PenunjangTindakanQuery;
use App\Http\Requests\Layanan\PenunjangTindakanRequest;
use App\Http\Resources\Layanan\PenunjangTindakanResource;

class PenunjangTindakanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_penunjang');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PenunjangTindakanQuery $query)
    {
        return PenunjangTindakanResource::collection(
            PenunjangTindakan::with(['tindakan', 'petugas'])->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenunjangTindakanRequest $request)
    {
        return response()->crud(new PenunjangTindakanResource(
            PenunjangTindakan::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\PenunjangTindakan  $penunjang_tindakan
     * @return \Illuminate\Http\Response
     */
    public function show(PenunjangTindakan $penunjang_tindakan)
    {
        return new PenunjangTindakanResource($penunjang_tindakan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\PenunjangTindakan  $penunjang_tindakan
     * @return \Illuminate\Http\Response
     */
    public function update(
        PenunjangTindakanRequest $request, PenunjangTindakan $penunjang_tindakan
    ) {
        return response()->crud(new PenunjangTindakanResource(
            tap($penunjang_tindakan)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\PenunjangTindakan  $penunjang_tindakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenunjangTindakan $penunjang_tindakan)
    {
        return response()->crud(tap($penunjang_tindakan)->delete());
    }
}

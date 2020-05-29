<?php

namespace App\Http\Controllers\Logistik;

use Sty\HttpQuery;
use App\Models\Logistik\Penerimaan;
use App\Http\Requests\Logistik\PenerimaanRequest;
use App\Http\Resources\Logistik\PenerimaanResource;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return PenerimaanResource::collection(
            Penerimaan::with('suplier')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenerimaanRequest $request)
    {
        return response()->crud(
            new PenerimaanResource(Penerimaan::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistik\Penerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function show(Penerimaan $penerimaan)
    {
        return new PenerimaanResource($penerimaan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logistik\Penerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function update(PenerimaanRequest $request, Penerimaan $penerimaan)
    {
        return response()->crud(
            new PenerimaanResource(tap($penerimaan)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistik\Penerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerimaan $penerimaan)
    {
        return response()->crud(tap($penerimaan)->delete());
    }
}

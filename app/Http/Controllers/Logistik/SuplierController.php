<?php

namespace App\Http\Controllers\Logistik;

use Sty\HttpQuery;
use App\Models\Logistik\Suplier;
use App\Http\Requests\Logistik\SuplierRequest;
use App\Http\Resources\Logistik\SuplierResource;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return SuplierResource::collection(Suplier::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuplierRequest $request)
    {
        return response()->crud(
            new SuplierResource(Suplier::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistik\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function show(Suplier $suplier)
    {
        return new SuplierResource($suplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logistik\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function update(SuplierRequest $request, Suplier $suplier)
    {
        return response()->crud(
            new SuplierResource(tap($suplier)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistik\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suplier $suplier)
    {
        return response()->crud(tap($suplier)->delete());
    }
}

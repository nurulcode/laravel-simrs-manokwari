<?php

namespace App\Http\Controllers\Logistik;

use App\Models\Logistik\Logistik;
use App\Http\Queries\Logistik\LogistikQuery;
use App\Http\Requests\Logistik\LogistikRequest;
use App\Http\Resources\Logistik\LogistikResource;

class LogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LogistikQuery $query)
    {
        return LogistikResource::collection(
            Logistik::stock()->with('jenis')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LogistikRequest $request)
    {
        return response()->crud(
            new LogistikResource(Logistik::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistik\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function show(Logistik $logistik)
    {
        return new LogistikResource($logistik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logistik\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function update(LogistikRequest $request, Logistik $logistik)
    {
        return response()->crud(
            new LogistikResource(tap($logistik)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistik\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logistik $logistik)
    {
        return response()->crud(tap($logistik)->delete());
    }
}

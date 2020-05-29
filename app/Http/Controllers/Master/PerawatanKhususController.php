<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Models\Master\PerawatanKhusus;
use App\Http\Requests\Master\PerawatanKhususRequest;
use App\Http\Resources\Master\PerawatanKhususResource;

class PerawatanKhususController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return PerawatanKhususResource::collection(PerawatanKhusus::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerawatanKhususRequest $request)
    {
        return response()->crud(
            new PerawatanKhususResource(
                PerawatanKhusus::with('parent')->create($request->validated())
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\PerawatanKhusus  $perawatan_khusus
     * @return \Illuminate\Http\Response
     */
    public function show(PerawatanKhusus $perawatan_khusus)
    {
        return new PerawatanKhususResource($perawatan_khusus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\PerawatanKhusus  $perawatan_khusus
     * @return \Illuminate\Http\Response
     */
    public function update(PerawatanKhususRequest $request, PerawatanKhusus $perawatan_khusus)
    {
        return response()->crud(
            new PerawatanKhususResource(tap($perawatan_khusus)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\PerawatanKhusus  $perawatan_khusus
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerawatanKhusus $perawatan_khusus)
    {
        return response()->crud(tap($perawatan_khusus)->delete());
    }
}

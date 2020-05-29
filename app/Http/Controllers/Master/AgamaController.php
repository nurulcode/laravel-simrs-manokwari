<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Models\Master\Agama;
use Illuminate\Http\Request;
use App\Http\Resources\Master\Resource;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(Agama::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(
            new Resource(Agama::create($request->only('uraian')))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function show(Agama $agama)
    {
        return new Resource($agama);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agama $agama)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(
            new Resource(tap($agama)->update($request->only('uraian')))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agama $agama)
    {
        return response()->crud(tap($agama)->delete());
    }
}

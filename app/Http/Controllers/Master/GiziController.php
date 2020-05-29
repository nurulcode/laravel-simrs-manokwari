<?php

namespace App\Http\Controllers\Master;

use App\Models\Master\Gizi;
use Illuminate\Http\Request;
use Sty\HttpQuery;
use App\Http\Resources\Master\Resource;

class GiziController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(Gizi::filter($query));
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
            new Resource(Gizi::create($request->only('uraian')))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Gizi  $gizi
     * @return \Illuminate\Http\Response
     */
    public function show(Gizi $gizi)
    {
        return new Resource($gizi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Gizi  $gizi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gizi $gizi)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(
            new Resource(tap($gizi)->update($request->only('uraian')))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Gizi  $gizi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gizi $gizi)
    {
        return response()->crud(tap($gizi)->delete());
    }
}

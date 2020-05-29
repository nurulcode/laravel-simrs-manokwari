<?php

namespace App\Http\Controllers\Master;

use App\Models\Master\Oksigen;
use Illuminate\Http\Request;
use Sty\HttpQuery;
use App\Http\Resources\Master\Resource;

class OksigenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(Oksigen::filter($query));
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

        return response()->crud(new Resource(
            Oksigen::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Oksigen  $oksigen
     * @return \Illuminate\Http\Response
     */
    public function show(Oksigen $oksigen)
    {
        return  new Resource($oksigen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Oksigen  $oksigen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oksigen $oksigen)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($oksigen)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Oksigen  $oksigen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oksigen $oksigen)
    {
        return response()->crud(tap($oksigen)->delete());
    }
}

<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Models\Master\JenisLaundry;
use App\Http\Requests\Master\JenisLaundryRequest;
use App\Http\Resources\Master\JenisLaundryResource;

class JenisLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return JenisLaundryResource::collection(JenisLaundry::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisLaundryRequest $request)
    {
        return response()->crud(
            new JenisLaundryResource(JenisLaundry::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\JenisLaundry  $jenis_laundry
     * @return \Illuminate\Http\Response
     */
    public function show(JenisLaundry $jenis_laundry)
    {
        return new JenisLaundryResource($jenis_laundry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\JenisLaundry  $jenis_laundry
     * @return \Illuminate\Http\Response
     */
    public function update(JenisLaundryRequest $request, JenisLaundry $jenis_laundry)
    {
        return response()->crud(
            new JenisLaundryResource(tap($jenis_laundry)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\JenisLaundry  $jenis_laundry
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisLaundry $jenis_laundry)
    {
        return response()->crud(tap($jenis_laundry)->delete());
    }
}

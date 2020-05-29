<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Laundry;
use App\Http\Queries\LayananQuery;
use App\Http\Requests\Layanan\LaundryRequest;
use App\Http\Resources\Layanan\LaundryResource;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return LaundryResource::collection(
            Laundry::with('jenis_laundry')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaundryRequest $request)
    {
        return response()->crud(
            new LaundryResource(Laundry::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function show(Laundry $laundry)
    {
        return new LaundryResource($laundry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function update(LaundryRequest $request, Laundry $laundry)
    {
        return response()->crud(
            new LaundryResource(tap($laundry)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laundry $laundry)
    {
        return response()->crud(tap($laundry)->delete());
    }
}

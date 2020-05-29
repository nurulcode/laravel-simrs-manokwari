<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Http\Resources\PasienResource;
use App\Http\Requests\CreatePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use App\Http\Queries\PasienQuery;

class PasienController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:manage_pasien')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PasienQuery $query)
    {
        return PasienResource::collection(
            Pasien::with([
                'agama',
                'jenis_identitas',
                'suku',
                'pendidikan',
                'pekerjaan',
                'provinsi',
                'kota_kabupaten',
                'kecamatan',
                'kelurahan'])
            ->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreatePasienRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePasienRequest $request)
    {
        return response()->crud(
            new PasienResource(
                Pasien::create($request->validated())->load([
                    'agama',
                    'jenis_identitas',
                    'suku',
                    'pendidikan',
                    'pekerjaan',
                    'provinsi',
                    'kota_kabupaten',
                    'kecamatan',
                    'kelurahan'
                ]
            ))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(Pasien $pasien)
    {
        return new PasienResource($pasien);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePasienRequest $request, Pasien $pasien)
    {
        return response()->crud(
            new PasienResource(tap($pasien)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien)
    {
        return response()->crud(tap($pasien)->delete());
    }
}

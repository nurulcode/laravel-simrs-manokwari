<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;
use App\Http\Resources\Master\PemeriksaanUmumResource;

class PemeriksaanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $petugas     = PegawaiResource::make($this->whenLoaded('petugas'));

        $pemeriksaan = PemeriksaanUmumResource::make($this->whenLoaded('pemeriksaan_umum'));

        return [
            'id'                  => $this->id,
            'pemeriksaan_umum_id' => $this->pemeriksaan_umum_id,
            'pemeriksaan_umum'    => $pemeriksaan,
            'hasil'               => $this->hasil,
            'petugas'             => $petugas,
            'waktu'               => $this->waktu,
            'path'                => $this->path,
        ];
    }
}

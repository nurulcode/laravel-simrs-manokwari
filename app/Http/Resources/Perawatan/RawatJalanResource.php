<?php

namespace App\Http\Resources\Perawatan;

use App\Http\Resources\KunjunganResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Fasilitas\PoliklinikResource;

class RawatJalanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'poliklinik_id' => $this->poliklinik_id,
            'waktu_masuk'   => $this->waktu_masuk,
            'waktu_keluar'  => $this->waktu_keluar,
            'poliklinik'    => PoliklinikResource::make($this->whenLoaded('poliklinik')),
            'kunjungan'     => KunjunganResource::make($this->whenLoaded('kunjungan')),
            'path'          => $this->path
        ];
    }
}

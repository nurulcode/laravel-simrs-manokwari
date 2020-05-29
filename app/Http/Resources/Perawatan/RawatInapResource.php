<?php

namespace App\Http\Resources\Perawatan;

use App\Http\Resources\KunjunganResource;
use App\Http\Resources\Fasilitas\KamarResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Fasilitas\RanjangResource;
use App\Http\Resources\Fasilitas\RuanganResource;
use App\Http\Resources\Fasilitas\PoliklinikResource;

class RawatInapResource extends JsonResource
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
            'waktu_masuk'   => (string) $this->waktu_masuk,
            'waktu_keluar'  => (string) $this->waktu_keluar,
            'poliklinik_id' => $this->poliklinik_id,
            'poliklinik'    => PoliklinikResource::make($this->whenLoaded('poliklinik')),
            'ruangan_id'    => $this->ruangan_id,
            'ruangan'       => RuanganResource::make($this->whenLoaded('ruangan')),
            'kamar_id'      => $this->kamar_id,
            'kamar'         => KamarResource::make($this->whenLoaded('kamar')),
            'ranjang_id'    => $this->ranjang_id,
            'ranjang'       => RanjangResource::make($this->whenLoaded('ranjang')),
            'kunjungan'     => KunjunganResource::make($this->whenLoaded('kunjungan')),
            'path'          => $this->path
        ];
    }
}

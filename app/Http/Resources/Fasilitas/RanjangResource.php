<?php

namespace App\Http\Resources\Fasilitas;

use Illuminate\Http\Resources\Json\JsonResource;

class RanjangResource extends JsonResource
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
            'kamar_id'      => $this->kamar_id,
            'kamar'         => KamarResource::make($this->whenLoaded('kamar')),
            'ruangan_id'    => $this->ruangan_id,
            'ruangan'       => RuanganResource::make($this->whenLoaded('ruangan')),
            'poliklinik_id' => $this->poliklinik_id,
            'poliklinik'    => PoliklinikResource::make($this->whenLoaded('poliklinik')),
            'kode'          => $this->kode,
            'path'          => $this->path,
        ];
    }
}

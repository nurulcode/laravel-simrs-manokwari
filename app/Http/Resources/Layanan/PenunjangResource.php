<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Fasilitas\PoliklinikResource;

class PenunjangResource extends JsonResource
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
            'perawatan'     => $this->whenLoaded('perawatan'),
            'poliklinik_id' => $this->poliklinik_id,
            'poliklinik'    => PoliklinikResource::make($this->whenLoaded('poliklinik')),
            'waktu'         => $this->waktu,
            'catatan'       => $this->catatan,
            'path'          => $this->slug,
        ];
    }
}

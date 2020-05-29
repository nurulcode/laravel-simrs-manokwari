<?php

namespace App\Http\Resources\Layanan;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;

class GiziResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $gizi    = Resource::make($this->whenLoaded('gizi'));

        $petugas = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'         => $this->id,
            'jumlah'     => $this->jumlah,
            'petugas_id' => $this->petugas_id,
            'petugas'    => $petugas,
            'waktu'      => $this->waktu,
            'tarif'      => $this->tarif,
            'gizi_id'    => $this->gizi_id,
            'gizi'       => $gizi,
            'path'       => $this->path,
        ];
    }
}

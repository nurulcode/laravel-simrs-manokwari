<?php

namespace App\Http\Resources\Layanan;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;

class VisiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $visite   = Resource::make($this->whenLoaded('jenis_visite'));

        $petugas  = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'              => $this->id,
            'jenis_visite_id' => $this->jenis_visite_id,
            'jenis_visite'    => $visite,
            'petugas_id'      => $this->petugas_id,
            'petugas'         => $petugas,
            'tarif'           => $this->tarif,
            'waktu'           => $this->waktu,
            'path'            => $this->path,
        ];
    }
}

<?php

namespace App\Http\Resources\Layanan;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;

class OksigenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $oksigen = Resource::make($this->whenLoaded('oksigen'));

        $petugas  = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'         => $this->id,
            'jumlah'     => $this->jumlah,
            'petugas_id' => $this->petugas_id,
            'petugas'    => $petugas,
            'waktu'      => $this->waktu,
            'tarif'      => $this->tarif,
            'oksigen_id' => $this->oksigen_id,
            'oksigen'    => $oksigen,
            'path'       => $this->path,
        ];
    }
}

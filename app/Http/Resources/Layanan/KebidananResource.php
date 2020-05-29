<?php

namespace App\Http\Resources\Layanan;

use App\Http\Resources\Master\KegiatanResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;

class KebidananResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $tindakan = KegiatanResource::make($this->whenLoaded('kegiatan'));

        $petugas  = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'          => $this->id,
            'jumlah'      => $this->jumlah,
            'petugas_id'  => $this->petugas_id,
            'petugas'     => $petugas,
            'waktu'       => $this->waktu,
            'tarif'       => $this->when($this->tarif, $this->tarif),
            'kegiatan_id' => $this->kegiatan_id,
            'kegiatan'    => $tindakan,
            'path'        => $this->path,
        ];
    }
}

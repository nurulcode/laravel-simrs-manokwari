<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Logistik\LogistikResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;

class ResepDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $obat    = LogistikResource::make($this->whenLoaded('obat'));

        $petugas = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'           => $this->id,
            'resep_id'     => $this->resep_id,
            'resep'        => ResepResource::make($this->whenLoaded('resep')),
            'jumlah'       => $this->jumlah,
            'petugas'      => $petugas,
            'obat_id'      => $this->obat_id,
            'obat'         => $obat,
            'aturan_pakai' => $this->aturan_pakai,
            'petugas_id'   => $this->petugas_id,
            'waktu'        => $this->waktu,
            'path'         => $this->path,
        ];
    }
}

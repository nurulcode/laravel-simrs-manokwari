<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;
use App\Http\Resources\Master\TindakanPemeriksaanResource;

class TindakanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $tindakan = TindakanPemeriksaanResource::make($this->whenLoaded('tindakan_pemeriksaan'));

        $petugas  = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'                      => $this->id,
            'jumlah'                  => $this->jumlah,
            'petugas_id'              => $this->petugas_id,
            'petugas'                 => $petugas,
            'waktu'                   => $this->waktu,
            'tarif'                   => $this->tarif,
            'tindakan_pemeriksaan_id' => $this->tindakan_pemeriksaan_id,
            'tindakan_pemeriksaan'    => $tindakan,
            'path'                    => $this->path,
        ];
    }
}

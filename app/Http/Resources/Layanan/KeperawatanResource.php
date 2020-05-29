<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;
use App\Http\Resources\Master\PerawatanKhususResource;

class KeperawatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $perawatan_khusus = PerawatanKhususResource::make($this->whenLoaded('perawatan_khusus'));

        $petugas  = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'                  => $this->id,
            'jumlah'              => $this->jumlah,
            'petugas_id'          => $this->petugas_id,
            'petugas'             => $petugas,
            'waktu'               => $this->waktu,
            'tarif'               => $this->tarif,
            'perawatan_khusus_id' => $this->perawatan_khusus_id,
            'perawatan_khusus'    => $perawatan_khusus,
            'path'                => $this->path,
        ];
    }
}

<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;

class PenunjangTindakanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $petugas  = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'          => $this->id,
            'penunjang'   => $this->whenLoaded('penunjang'),
            'tindakan_id' => $this->tindakan_id,
            'tindakan'    => $this->whenLoaded('tindakan'),
            'waktu'       => $this->waktu,
            'jumlah'      => $this->jumlah,
            'catatan'     => $this->catatan,
            'petugas_id'  => $this->petugas_id,
            'petugas'     => $petugas,
            'tarif'       => $this->tarif,
            'path'        => $this->path,
        ];
    }
}

<?php

namespace App\Http\Resources\Master\Penyakit;

use Illuminate\Http\Resources\Json\JsonResource;

class KelompokPenyakitResource extends JsonResource
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
            'id'             => $this->id,
            'icd'            => $this->icd,
            'kode'           => $this->kode,
            'klasifikasi_id' => $this->klasifikasi_id,
            'klasifikasi'    => KlasifikasiPenyakitResource::make($this->whenLoaded('klasifikasi')),
            'uraian'         => $this->uraian,
            'path'           => $this->path,
        ];
    }
}

<?php

namespace App\Http\Resources\Master\Penyakit;

use Illuminate\Http\Resources\Json\JsonResource;

class KlasifikasiPenyakitResource extends JsonResource
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
            'id'     => $this->id,
            'kode'   => $this->kode,
            'uraian' => $this->uraian,
            'path'   => $this->path,
        ];
    }
}

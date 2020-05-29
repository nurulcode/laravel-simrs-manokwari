<?php

namespace App\Http\Resources\Master\Penyakit;

use Illuminate\Http\Resources\Json\JsonResource;

class PenyakitResource extends JsonResource
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
            'id'          => $this->id,
            'icd'         => $this->icd,
            'kelompok_id' => $this->kelompok_id,
            'kelompok'    => KelompokPenyakitResource::make($this->whenLoaded('kelompok')),
            'path'        => $this->path,
            'uraian'      => $this->uraian,
        ];
    }
}

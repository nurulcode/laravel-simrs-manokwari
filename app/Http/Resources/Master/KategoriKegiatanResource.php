<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriKegiatanResource extends JsonResource
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
            'uraian' => $this->uraian,
            'path'   => $this->path,
            'kode'   => $this->getPivotKode(),
        ];
    }

    protected function getPivotKode()
    {
        return $this->whenPivotLoaded('kategori_kegiatan_kegiatan', function () {
            return $this->pivot->kode;
        });
    }
}

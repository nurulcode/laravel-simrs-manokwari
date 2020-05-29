<?php

namespace App\Http\Resources\Kepegawaian;

use Illuminate\Http\Resources\Json\JsonResource;

class KualifikasiResource extends JsonResource
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
            'kategori_id' => $this->kategori_id,
            'kategori'    => KategoriKualifikasiResource::make($this->whenLoaded('kategori')),
            'kode'        => $this->kode,
            'uraian'      => $this->uraian,
            'laki_laki'   => $this->laki_laki,
            'perempuan'   => $this->perempuan,
            'path'        => $this->path,
            '__editable'  => $request->user()->can('update', $this->resource),
            '__deletable' => $request->user()->can('delete', $this->resource),
        ];
    }
}

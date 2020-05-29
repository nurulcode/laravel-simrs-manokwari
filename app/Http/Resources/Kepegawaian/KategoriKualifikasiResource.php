<?php

namespace App\Http\Resources\Kepegawaian;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriKualifikasiResource extends JsonResource
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
            'id'           => $this->id,
            'kode'         => $this->kode,
            'tenaga_medis' => $this->tenaga_medis,
            'uraian'       => $this->uraian,
            'path'         => $this->path,
            '__editable'   => $request->user()->can('update', $this->resource),
            '__deletable'  => $request->user()->can('delete', $this->resource),
        ];
    }
}

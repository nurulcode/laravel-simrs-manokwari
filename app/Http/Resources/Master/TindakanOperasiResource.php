<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class TindakanOperasiResource extends JsonResource
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
            'id'        => $this->id,
            'kode'      => $this->when($this->kode, function () {
                return $this->kode;
            }),
            'parent_id' => $this->when($this->parent_id, function () {
                return $this->parent_id;
            }),
            'parent'    => self::make($this->whenLoaded('parent')),
            'childs'    => self::collection($this->whenLoaded('childs')),
            'uraian'    => $this->uraian,
            'jenis'     => $this->jenis,
            'path'      => $this->path,
            'tarif'     => $this->when($this->tarif, function () {
                return [
                    'tarifable_type' => get_class($this->resource),
                    'tarifable_id'   => $this->id,
                    'tarif'          => $this->tarif
                ];
            }),
        ];
    }
}

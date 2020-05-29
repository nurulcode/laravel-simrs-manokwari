<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Fasilitas\PoliklinikResource;

class TindakanPemeriksaanResource extends JsonResource
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
            'parent_id'   => $this->parent_id,
            'parent'      => self::make($this->whenLoaded('parent')),
            'prosedur_id' => $this->prosedur_id,
            'prosedur'    => Resource::make($this->whenLoaded('prosedur')),
            'kode'        => $this->kode,
            'uraian'      => $this->uraian,
            'jenis'       => $this->jenis,
            'polikliniks' => PoliklinikResource::collection($this->whenLoaded('polikliniks')),
            'tarif'       => [
                'tarifable_type' => get_class($this->resource),
                'tarifable_id'   => $this->id,
                'tarif'          => $this->tarif
            ],
            'path'        => $this->path,
        ];
    }
}

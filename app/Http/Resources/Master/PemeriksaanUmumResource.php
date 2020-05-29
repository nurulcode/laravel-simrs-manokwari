<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class PemeriksaanUmumResource extends JsonResource
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
            'kode'      => $this->kode,
            'parent'    => self::make($this->whenLoaded('parent')),
            'parent_id' => $this->parent_id,
            'uraian'    => $this->uraian,
            'satuan'    => $this->satuan,
            'periode'   => $this->periode,
            'path'      => $this->path,
            'childs'    => self::collection($this->whenLoaded('childs'))
        ];
    }
}

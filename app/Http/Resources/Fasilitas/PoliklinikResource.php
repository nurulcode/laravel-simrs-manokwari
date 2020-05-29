<?php

namespace App\Http\Resources\Fasilitas;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;

class PoliklinikResource extends JsonResource
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
            'id'       => $this->id,
            'nama'     => $this->nama,
            'kode'     => $this->kode,
            'jenis_id' => $this->jenis_id,
            'jenis'    => Resource::make($this->whenLoaded('jenis')),
            'path'     => $this->path,
        ];
    }
}

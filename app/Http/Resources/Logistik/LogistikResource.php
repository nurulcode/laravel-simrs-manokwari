<?php

namespace App\Http\Resources\Logistik;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Master\Resource;

class LogistikResource extends JsonResource
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
            'id'            => $this->id,
            'uraian'        => $this->uraian,
            'satuan'        => $this->satuan,
            'golongan'      => $this->golongan,
            'harga_jual'    => $this->harga_jual,
            'jenis_id'      => $this->jenis_id,
            'jenis'         => Resource::make($this->whenLoaded('jenis')),
            'path'          => $this->path,
            'apotek_id'     => $this->when($this->poliklinik_id, function () {
                return $this->poliklinik_id;
            }),
            'apotek' => $this->when($this->poliklinik, function () {
                return $this->poliklinik;
            }),
            'stock'      => $this->stock,
        ];
    }
}

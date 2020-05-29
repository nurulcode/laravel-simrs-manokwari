<?php

namespace App\Http\Resources\Logistik;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Fasilitas\PoliklinikResource;
use App\Enums\JenisTransaksi;

class TransaksiResource extends JsonResource
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
            'jenis'       => JenisTransaksi::getDescription((int) $this->jenis),
            'faktur_type' => $this->faktur_type,
            'faktur_id'   => $this->faktur_id,
            'faktur'      => $this->whenLoaded('faktur'),
            'apotek_id'   => $this->apotek_id,
            'apotek'      => PoliklinikResource::make($this->whenLoaded('apotek')),
            'logistik_id' => $this->logistik_id,
            'logistik'    => LogistikResource::make($this->whenLoaded('logistik')),
            'harga'       => $this->harga,
            'jumlah'      => $this->jumlah,
            'path'        => $this->path,
        ];
    }
}

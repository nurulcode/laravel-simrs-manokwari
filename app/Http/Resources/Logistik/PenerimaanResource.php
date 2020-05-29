<?php

namespace App\Http\Resources\Logistik;

use Illuminate\Http\Resources\Json\JsonResource;

class PenerimaanResource extends JsonResource
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
            'id'                => $this->id,
            'no_faktur'         => $this->no_faktur,
            'tanggal_faktur'    => $this->tanggal_faktur,
            'jatuh_tempo'       => $this->jatuh_tempo,
            'tanggal_terima'    => $this->tanggal_terima,
            'sistem_pembayaran' => $this->sistem_pembayaran,
            'suplier_id'        => $this->suplier_id,
            'suplier'           => SuplierResource::make($this->whenLoaded('suplier')),
            'path'              => $this->path,
        ];
    }
}

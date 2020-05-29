<?php

namespace App\Http\Resources\Master\Wilayah;

use Illuminate\Http\Resources\Json\JsonResource;

class KecamatanResource extends JsonResource
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
            'name'              => $this->name,
            'provinsi_id'       => $this->provinsi_id,
            'provinsi'          => ProvinsiResource::make($this->whenLoaded('provinsi')),
            'kota_kabupaten_id' => $this->kota_kabupaten_id,
            'kota_kabupaten'    => KotaKabupatenResource::make($this->whenLoaded('kota_kabupaten')),
            'path'              => $this->path,
        ];
    }
}

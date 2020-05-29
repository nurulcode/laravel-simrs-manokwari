<?php

namespace App\Http\Resources\Layanan;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Master\JenisLaundryResource;

class LaundryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $jenis_laundry = JenisLaundryResource::make($this->whenLoaded('jenis_laundry'));

        return [
            'id'               => $this->id,
            'jumlah'           => $this->jumlah,
            'waktu'            => $this->waktu,
            'tarif'            => $this->tarif,
            'jenis_laundry_id' => $this->jenis_laundry_id,
            'jenis_laundry'    => $jenis_laundry,
            'path'             => $this->path,
        ];
    }
}

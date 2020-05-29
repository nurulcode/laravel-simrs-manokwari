<?php

namespace App\Http\Resources\Logistik;

use Illuminate\Http\Resources\Json\JsonResource;

class SuplierResource extends JsonResource
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
            'id'         => $this->id,
            'nama'       => $this->nama,
            'alamat'     => $this->alamat,
            'no_telepon' => $this->no_telepon,
            'path'       => $this->path,
        ];
    }
}

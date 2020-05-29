<?php

namespace App\Http\Resources\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;

class ResepResource extends JsonResource
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
            'id'             => $this->id,
            'perawatan_id'   => $this->perawatan_id,
            'perawatan_type' => $this->perawatan_type,
            'perawatan'      => $this->perawatan,
            'path'           => $this->path,
        ];
    }
}

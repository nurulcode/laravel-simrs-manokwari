<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'type'       => $this->type,
            'before'     => $this->before,
            'after'      => $this->after,
            'created_at' => $this->created_at->toDateTimeString(),
            'subject'    => $this->whenLoaded('subject'),
            'user'       => new UserResource($this->whenLoaded('user')),
        ];
    }
}

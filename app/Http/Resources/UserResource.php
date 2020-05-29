<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username'    => $this->username,
            'name'        => $this->name,
            'email'       => $this->email,
            'active'      => $this->active,
            'last_login'  => $this->last_login,
            'roles'       => RoleResource::collection($this->whenLoaded('roles')),
            'path'        => $this->path,
            '__editable'  => $request->user()->can('update', $this->resource),
            '__deletable' => $request->user()->can('delete', $this->resource),
        ];
    }
}

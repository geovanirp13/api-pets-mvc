<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'zipcode'      => $this->zipcode,
            'address'      => $this->address,
            'neighborhood' => $this->neighborhood,
            'city'         => $this->city,
            'state'        => $this->state,
            'number'       => $this->number
        ];
    }
}

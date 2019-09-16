<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Authors extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address
        ];
    }
}

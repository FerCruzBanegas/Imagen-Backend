<?php

namespace App\Http\Resources\Office;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'address' => $this->address,
            'phone_one' => $this->phone_one,
            'phone_two' => $this->phone_two,
            'email' => $this->email,
            'city' => $this->city->name
        ];
    }
}

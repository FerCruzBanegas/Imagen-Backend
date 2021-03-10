<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'business_name' => $this->business_name,
            'address' => $this->address,
            'nit' => $this->nit,
            'phone' => $this->phone,
            'email' => $this->email,
            'city' => ['id' => $this->city->id, 'name' => $this->city->name]
        ];
    }
}

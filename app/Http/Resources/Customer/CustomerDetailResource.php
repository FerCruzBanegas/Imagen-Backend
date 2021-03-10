<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerDetailResource extends JsonResource
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
            'city' => $this->city->name,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}

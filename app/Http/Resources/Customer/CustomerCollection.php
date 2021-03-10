<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($customer){
                return [
                    'id' => $customer->id,
                    'business_name' => $customer->business_name,
                    'address' => $customer->address,
                    'nit' => $customer->nit,
                    'phone' => $customer->phone,
                    'email' => $customer->email,
                    'city' => ['name' => $customer->city->name],
                    'created' => $customer->created_at,
                ];
            }),
        ];
    }
}

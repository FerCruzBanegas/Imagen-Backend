<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Payment\PaymentResource;

class PaymentCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($payment){
                return new PaymentResource($payment);
            }),
        ];
    }
}

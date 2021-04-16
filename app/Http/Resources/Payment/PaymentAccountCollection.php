<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Payment\PaymentAccountResource;

class PaymentAccountCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function($payment){
            return new PaymentAccountResource($payment);
        });
    }
}

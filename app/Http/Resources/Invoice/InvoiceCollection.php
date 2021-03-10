<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Invoice\InvoiceResource;

class InvoiceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($invoice){
                return new InvoiceResource($invoice);
            }),
        ];
    }
}

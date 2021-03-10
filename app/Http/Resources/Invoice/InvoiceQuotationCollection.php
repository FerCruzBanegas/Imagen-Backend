<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Invoice\InvoiceResource;

class InvoiceQuotationCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function($invoice){
            return new InvoiceResource($invoice);
        });
    }
}

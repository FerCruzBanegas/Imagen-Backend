<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerQuotesCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($quotation){
                return [
                    'id' => $quotation->id,
                    'cite' => $quotation->cite,
                    'date' => $quotation->date,
                    'amount' => number_format($quotation->amount - $quotation->discount, 2, '.', ','),
                    'state' => $quotation->state->title,
                    'user' => $quotation->user->name,
                ];
            }),
        ];
    }
}

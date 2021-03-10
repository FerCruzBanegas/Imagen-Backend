<?php

namespace App\Http\Resources\Quotation;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Payment\PaymentCollection;

class QuotationReceivableCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($quotation){
                $amount_pay = $quotation->payments->sum('amount');
                return [
                    'id' => $quotation->id,
                    'cite' => $quotation->cite,
                    // 'date' => $quotation->date,
                    'amount' => number_format($quotation->amount - $quotation->discount, 2, '.', ','),
                    'condition' => $quotation->condition,
                    'state' => ['title' => $quotation->state->title],
                    'customer' => ['business_name' => $quotation->customer->business_name],
                    'customer_data' => new CustomerResource($quotation->customer),
                    'user' => ['name' => $quotation->user->name],
                    'payments' => new PaymentCollection($quotation->payments),
                    'voucher' => $quotation->condition,
                    'amount_paid' => number_format($amount_pay, 2, '.', ','),
                    'balance' => number_format($quotation->amount - $amount_pay, 2, '.', ','),
                ];
            }),
        ];
    }
}

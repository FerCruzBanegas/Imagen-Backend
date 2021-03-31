<?php

namespace App\Transformers;
use Carbon\Carbon;

class CustomerTransformer extends Transformer
{
    protected $resourceName = 'customer';

    public function transform($data)
    {
        return [
            'business_name' => $data['business_name'],
            'nit' => $data['nit'],
            'phone'    => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'city' => $data['city']['name'],
        ];
    }

    public function getAccounts($data)
    {
        return [
            'business_name' => $data['business_name'],
            'nit' => $data['nit'],
            'phone'    => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'invoices' => collect($data['invoices'])->transform(function($invoice) {
                return [
                    'id' => $invoice->id,
                    'date' => $invoice->date,
                    'type' => $invoice->type,
                    'number' => $invoice->number,
                    'summary' => $invoice->summary,
                    'total' => $invoice->total,
                    'payments' => $invoice->payments
                ];
            }) 
        ];
    }
}
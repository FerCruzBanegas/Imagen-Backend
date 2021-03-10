<?php

namespace App\Transformers;
use Carbon\Carbon;

class AccountTransformer extends Transformer
{
    protected $resourceName = 'account';

    public function transform($data)
    {
        $amount_pay = $data['payments']->sum('amount');
        return [
            'id' => $data['id'],
            'cite' => $data['quotation']['cite'],
            'date' => Carbon::parse($data['date'])->format('d/m/Y'),
            'number' => str_pad($data['number'], 8, '0', STR_PAD_LEFT),
            'type' => $data['type'],
            'amount' => number_format($data['total'], 2, '.', ','),
            'closing_date' => Carbon::parse($data['closing_date'])->format('d/m/Y'),
            // 'payments' => new PaymentCollection($account->payments),
            'amount_paid' => number_format($amount_pay, 2, '.', ','),
            'balance' => number_format($data['total'] - $amount_pay, 2, '.', ','),
            'customer' => $data['customer']['business_name'],
            'user' => $data['user']['name'],
        ];
    }

    public function listTransform($data)
    {
        return [
            'id' => $data['id'],
            'number' => str_pad($data['number'], 8, '0', STR_PAD_LEFT),
            'date' => Carbon::parse($data['date'])->format('d/m/Y'),
            'total' => number_format($data['total'], 2, '.', ','),
            'customer' => $data['customer']['business_name'],
            'cite' => $data['quotation']['cite'],
        ];
    }
}
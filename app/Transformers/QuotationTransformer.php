<?php

namespace App\Transformers;
use Carbon\Carbon;

class QuotationTransformer extends Transformer
{
    protected $resourceName = 'quotation';

    public function transform($data)
    {
        return [
            'cite'     => $data['cite'],
            'date'     => Carbon::parse($data['date'])->format('d/m/Y'),
            'amount'   => number_format($data['amount'] - $data['discount'], 2, '.', ','),
            'state'    => $data['state']['title'],
            'customer' => $data['customer']['business_name'],
            'user'     => $data['user']['name'],
        ];
    }
}
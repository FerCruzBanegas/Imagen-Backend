<?php

namespace App\Transformers;
use Carbon\Carbon;

class NoteTransformer extends Transformer
{
    protected $resourceName = 'note';

    public function transform($data)
    {
        return [
            'id' => $data['id'],
            'number' => $data['number'],
            'date' => $data['date'],
            'total' => $data['accounts'] === 0 ? 0 : $data['total'],
            'discount' => $data['discount'],
            'accounts' => $data['accounts'] === 0 ? false : true,
            'customer' => [
                'name' => $data['customer']['business_name'],
                'nit' => $data['nit'],
            ],
            'voucher' => [
                'office' => [
                    'name' => $data['voucher']['office']['city']['name'],
                    'address' => explode(',', $data['voucher']['office']['detail'])
                ]
            ],
            'products' => collect($data['products'])->transform(function($product) {
                return [
                    'id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                    'description' => $product->pivot->description,
                    'price' => $product->pivot->price,
                    'subtotal' => $product->pivot->subtotal,
                ];
            }) 
        ];
    }

    public function listTransform($data)
    {
        return [
            'id' => $data['id'],
            'number' => str_pad($data['number'], 8, '0', STR_PAD_LEFT),
            'date' => Carbon::parse($data['date'])->format('d/m/Y'),
            'total' => $data['accounts'] === 0 ? number_format(0, 2, '.', ',') : number_format($data['total'], 2, '.', ','),
            'customer' => $data['customer']['business_name'],
            'cite' => $data['quotation']['cite'],
        ];
    }
}
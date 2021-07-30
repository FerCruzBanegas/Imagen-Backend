<?php

namespace App\Transformers;
use Carbon\Carbon;

class InvoiceTransformer extends Transformer
{
    protected $resourceName = 'invoice';

    public function transform($data)
    {
        return [
            'id' => $data['id'],
            'number' => $data['number'],
            'date' => $data['date'],
            'control_code' => $data['control_code'],
            'total' => $data['total'],
            'title' => $data['title'],
            'footer' => $data['footer'],
            // 'oc' => $data['oc'],
            // 'hea' => $data['hea'],
            'details' => array_map(function($iter) { return array('description' => $iter); }, explode('|', $data['details'])),
            'state' => ['title' => $data['state_id'] === 1 ? 'VÁLIDO' : 'ANULADO'],
            'customer' => [
                'name' => $data['nit_name'] ? $data['nit_name'] : $data['customer']['business_name'],
                'nit' => $data['nit'],
            ],
            'license' => [
                'nit' => $data['license']['nit'],
                'authorization' => $data['license']['authorization'],
                'deadline' => Carbon::parse($data['license']['deadline'])->format('d/m/Y'),
                'activity' => $data['license']['activity'],
                'legend' => $data['license']['legend'],
                'office' => [
                    'name' => $data['license']['office']['city']['name'],
                    'address' => explode(',', $data['license']['office']['detail'])
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
            // 'user'     => $data['user']['name'],
            // 'amount'   => number_format($data['amount'], 2, '.', ','),
        ];
    }

    public function listTransform($data)
    {
        return [
            'id' => $data['id'],
            'number' => str_pad($data['number'], 8, '0', STR_PAD_LEFT),
            'date' => Carbon::parse($data['date'])->format('d/m/Y'),
            'total' => $data['total'],
            'state' => $data['state_id'] === 1 ? 'VÁLIDO' : 'ANULADO',
            'nit_name' => is_null($data['nit_name']) ? $data['customer']['business_name'] : $data['nit_name'],
            'customer' => $data['customer']['business_name'],
            'cite' => $data['quotation']['cite'],
        ];
    }
}
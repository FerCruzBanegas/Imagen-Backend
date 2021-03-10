<?php

namespace App\Transformers;

class ProductTransformer extends Transformer
{
    protected $resourceName = 'product';

    public function transform($data)
    {
        return [
            'code' => $data['code'],
            'name' => $data['name'],
            'description' => $data['description'],
            'dimension' => $data['dimension'],
            'category' => $data['category']['name'],
        ];
    }
}
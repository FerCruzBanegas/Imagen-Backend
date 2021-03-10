<?php

namespace App\Transformers;

class EmployeeTransformer extends Transformer
{
    protected $resourceName = 'employee';

    public function transform($data)
    {
        return [
            'name'     => $data['name'],
            'document' => $data['document'],
            'num_document' => $data['num_document'],
            'address'    => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'office' => $data['office']['description'],
        ];
    }
}
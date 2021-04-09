<?php

namespace App\Transformers;

class DesignTransformer extends Transformer
{
    protected $resourceName = 'design';

    public function transform($data)
    {
        return [
            'id' => $data['id'],
            'cite' => $data['quotation']['quote']['cite'],
            'filename' => $data['filename'],
            'quality' => $data['quality'],
            'quantity' => $data['quotation']['quantity'],
            'material' => $data['material'],
            'machines' => $data['machines'],
            'cutting_dimension' => $data['cutting_dimension'],
            'print_dimension' => $data['print_dimension'],
            'finished' => $data['finished'],
            'test_print' => $data['test_print'],
            'quote_approved_date' => $data['quote_approved_date'],
            'design_approved_date' => $data['design_approved_date'],
            'reference' => $data['reference'],
            'path' => public_path('img/designs/') . $data['path'],
            'support_path' => is_null($data['support_path']) ? NULL : public_path('img/designs/') . $data['support_path'],
            'note' => $data['note'],
        ];
    }
}
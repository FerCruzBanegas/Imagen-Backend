<?php

namespace App\Http\Resources\Design;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'filename' => $this->filename,
            'machines' => $this->machines,

            'id' => $this->id,
            'filename' => $this->filename,
            // 'machine' => $product->pivot->design['machine'],
            'quality' => is_null($product->pivot->design['quality']) ? $product->pivot->quality : $product->pivot->design['quality'],
            'material' => is_null($product->pivot->design['material']) ? $product->pivot->material : $product->pivot->design['material'],
            'cutting_dimension' => $product->pivot->design['cutting_dimension'],
            'print_dimension' => $product->pivot->design['print_dimension'],
            'finished' => is_null($product->pivot->design['finished']) ? $product->pivot->finish : $product->pivot->design['finished'],
            'test_print' => $product->pivot->design['test_print'],
            'quote_approved_date' => $product->pivot->design['quote_approved_date'],
            'design_approved_date' => $product->pivot->design['design_approved_date'],
            'reference' => $product->pivot->design['reference'],
            'path' => [
                'name' => $product->pivot->design['path'],
                'url' => $product->pivot->design['path'] ? $this->getBase64Design($product->pivot->design['path']) : NULL,
            ],
            'support_path' => [
                'name' => $product->pivot->design['support_path'],
                'url' => $product->pivot->design['support_path'] ? $this->getBase64Design($product->pivot->design['support_path']) : NULL,
            ],
            'set_image_support' => $product->pivot->design['set_image_support'] === 1 ? true : false,
            'note' => $product->pivot->design['note'],
            'product_quotation_id' => $product->pivot->id,
            'machine_id' => new DesignResource($product->pivot->design),
            'quotation' => $this->id,
            'created' => $product->pivot->design['created_at'],
            'updated' => $product->pivot->design['updated_at'],
        ];
    }
}

<?php

namespace App\Http\Resources\Quotation;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cite' => $this->cite,
            'products' => collect($this->products)->transform(function($product){
                // $dim = explode(" x ", $product->pivot->dimension);
                $description = "";
                if($product->pivot->material) {
                    $description .= "Material: {$product->pivot->material} ";
                }
                if($product->pivot->quality) {
                    $description .= "Calidad: {$product->pivot->quality} ";
                }
                if($product->pivot->finish) {
                    $description .= "Acabado: {$product->pivot->finish} ";
                }
                return [
                    'id' => $product->id,
                    'item_id' => $product->pivot->id,
                    'uuid' => $product->pivot->uuid,
                    'quantity' => $product->pivot->quantity,
                    'name' => $product->name,
                    'description' => $description . $product->pivot->description,
                    'price' => number_format((float)$product->pivot->subtotal / $product->pivot->quantity, 2, '.', ','),
                    'subtotal' => $product->pivot->subtotal
                    // 'subtotal' => number_format((float)$product->pivot->subtotal, 2, '.', ''),
                ];
            })->sortBy('item_id')->values()->all(),
        ];
    }
}

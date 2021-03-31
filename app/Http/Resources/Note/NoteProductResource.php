<?php

namespace App\Http\Resources\Note;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'products' => collect($this->products)->transform(function($product){
                return [
                    'id' => $product->id,
                    'item_id' => $product->pivot->id,
                    'quantity' => $product->pivot->quantity,
                    'name' => $product->name,
                    'description' => $product->pivot->description,
                    'price' => $product->pivot->price,
                    'subtotal' => $product->pivot->subtotal
                ];
            })->sortBy('item_id')->values()->all(),
        ];
    }
}

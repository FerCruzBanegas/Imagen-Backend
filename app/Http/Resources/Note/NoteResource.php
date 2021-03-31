<?php

namespace App\Http\Resources\Note;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class NoteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => str_pad($this->number, 8, '0', STR_PAD_LEFT),
            'date' => $this->date,
            'subtotal' => $this->products()->sum('subtotal'),
            'total' => $this->total,
            'discount' => number_format($this->discount, 2, '.', ','),
            'summary' => $this->summary,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
            'customer' => ['name' => $this->customer->business_name],
            'customer_data' => [
                'business_name' => $this->customer->business_name,
                'nit' => $this->nit,
            ],
            'cite' => $this->quotation->cite,
            'quotation_id' => $this->quotation->id,
            'voucher' => [
                'office' => [
                    'id' => $this->voucher->office->id,
                    'name' => $this->voucher->office->city->name,
                    'address' => explode(',', $this->voucher->office->detail)
                ],
            ],
            'products' => collect($this->products)->transform(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $product->pivot->quantity,
                    'description' => $product->pivot->description,
                    'price' => number_format($product->pivot->price, 2, '.', ','),
                    'subtotal' => $product->pivot->subtotal,
                ];
            })
        ];
    }
}

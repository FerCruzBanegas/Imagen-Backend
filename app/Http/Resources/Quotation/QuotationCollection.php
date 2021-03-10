<?php

namespace App\Http\Resources\Quotation;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Invoice\InvoiceQuotationCollection;
use App\Http\Resources\Note\NoteResource;

class QuotationCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($quotation){
                return [
                    'id' => $quotation->id,
                    'cite' => $quotation->cite,
                    'date' => $quotation->date,
                    'amount' => number_format($quotation->amount - $quotation->discount, 2, '.', ','),
                    'discount' => number_format($quotation->discount, 2, '.', ','),
                    'condition' => $quotation->condition,
                    'state' => ['title' => $quotation->state->title],
                    'customer' => ['business_name' => $quotation->customer->business_name],
                    'customer_data' => new CustomerResource($quotation->customer),
                    'user' => ['name' => $quotation->user->name],
                    // 'invoice' => $quotation->invoice,
                    'products' => collect($quotation->products)->transform(function($product){
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
                    'invoice' => $quotation->invoices->count() > 0 ? new InvoiceQuotationCollection($quotation->invoices) : null,
                    'note' => $quotation->receipt ? new NoteResource($quotation->receipt) : $quotation->receipt,
                ];
            }),
        ];
    }
}
